<?php

namespace App\Http\Controllers\Api\v1;

use App\Client;
use App\Country;
use App\Http\Requests\ProjectRequest;
use App\Http\Controllers\Controller;
use App\Project;
use App\ProjectGallery;
use App\ProjectGalleryImage;
use App\ProjectSection;
use App\ProjectStickySection;
use App\ProjectTextInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Intervention\Image\Facades\Image;

/**
 * Class ProjectsController
 * @package App\Http\Controllers\Api\v1
 */
class ProjectsController extends Controller
{
    /**
     *
     */
    private $projectSections = [];

    /**
     * Public Upload Image Route
     *
     * @var string
     */
    protected $imageRoute = 'uploads/images/';

    /**
     * ProjectsController constructor.
     */
    public function __construct()
    {
        $this->projectSections = [
            class_basename(ProjectGallery::class) => array_fill_keys(
                Schema::getColumnListing((new ProjectGalleryImage())->getTable()),
                null
            ),
            class_basename(ProjectStickySection::class) => array_fill_keys(
                Schema::getColumnListing((new ProjectStickySection())->getTable()),
                null
            ),
            class_basename(ProjectTextInformation::class) => array_fill_keys(
                Schema::getColumnListing((new ProjectTextInformation())->getTable()),
                null
            ),
        ];

        $this->middleware('auth:api')->except(['index', 'show', 'getNextProject']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with('sections')->orderByDesc('is_featured')->get();

        return response()->json($projects, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        //Upload Images
        foreach (['hero_image', 'hero_image_preview'] as $image) {
            if ($request->get($image)) {
                $request->offsetSet($image, $this->uploadEncoded64Image($request->get($image)));
            } else {
                $request->offsetUnset($image);
            }
        }

        //Create Project Model
        $project = Project::create($request->all());

        //Save Project Sections
        $this->addProjectSections($request, $project);

        $project->load('sections');

        //Response
        return response()->json([
            'project' => $project,
            'success' => true,
            'message' => 'Project (ID: '.$project->id.') created successfully!',
            'projectId' => $project->id,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $project->load(
            'client',
            'services',
            'sections'
        );

        return response()->json($project, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $project->load('sections');

        return response()->json([
            'project' => $project,
            'clients' => Client::select('id', 'name')->get(),
            'countries' => Country::select('id', 'name')->get(),
            'sections' => $this->projectSections
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProjectRequest $request
     * @param Project        $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $request->offsetUnset('areas');
        $request->offsetUnset('services');

        //Save Project Sections
        $this->addProjectSections($request, $project);

        //Upload Images
        foreach (['hero_image', 'hero_image_preview'] as $image) {
            if ($request->get($image)) {
                $request->offsetSet($image, $this->uploadEncoded64Image($request->get($image)));
            } else {
                $request->offsetUnset($image);
            }
        }

        //Update Project Model
        $project->update($request->all());

        $project->load('sections');

        //Response
        return response()->json([
            'project' => $project,
            'success' => true,
            'projectId' => $project->id,
            'message' => 'Project (ID: '.$project->id.') edited successfully!',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }

    /**
     * Get next project by id from a projects collection
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function getNextProject($id)
    {
        $allProjects = Project::with('sections')->orderByDesc('is_featured')->get();

        if ($allProjects) {
            $projectIndex = $allProjects->pluck('id')->search($id);
            $nextElementByIndex = $allProjects->slice($projectIndex + 1, 1);

            if ($nextElementByIndex->isEmpty()) {
                $nextElementByIndex = $allProjects->slice(0, 1);
            }

            return response()->json($nextElementByIndex, 200);
        }

        return response()->json([], 200);

    }

    /**
     * Process Encode64 Image
     *
     * @param string $imageData
     * @return string URL
     */
    protected function uploadEncoded64Image($imageData)
    {
        $fileName = Carbon::now()->timestamp.'_'.uniqid().'.'.explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        $heroImage = Image::make($imageData)->save(public_path($this->imageRoute).$fileName);

        return DIRECTORY_SEPARATOR.$this->imageRoute.$heroImage->basename;
    }

    /**
     * Provides data for Config dropdowns on Form
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getConfigModels(Request $request)
    {
        return response()->json([
            'clients' => Client::select('id', 'name')->get(),
            'countries' => Country::select('id', 'name')->get(),
            'sections' => $this->projectSections
        ], 200);
    }

    /**
     * @param Request $request
     */
    protected function addProjectSections(Request $request, Project $project)
    {
        //Filter Remove Sections
        $sections = array_filter($request->get('sections'), function($section) {
            return !isset($section['visible']);
        });

        $removedSections =  array_filter($request->get('sections'), function($section) {
            return isset($section['visible']);
        });

        foreach($removedSections as $section) {
            if ($section['id']) {
                $project->sections()->find($section['id'])->delete();
            }
        }

        //Replace Sections offset with filtered data
        $request->replace(['sections' => $sections]);

        if ($request->offsetGet('sections')) {
            foreach ($request->offsetGet('sections') as $section) {
                if ($section['id'] and $section['component'] === 'ProjectTextInformation') {
                    $projectSection = ProjectSection::find($section['id']);

                    //@todo refactor using ternary, check weird behavior when implementing it
                    if ((preg_match('/^data\:image/', $section['background_image']))) {
                        $background = [ 'background_image' => $this->uploadEncoded64Image($section['background_image']) ];
                    } else {
                        $background = ($section['background_image']) ? ['0'] : ['background_image' => null];
                    }

                    $projectSection->update(array_merge([
                        'color' => $section['color'],
                        'is_dark' => $section['is_dark'],
                        //'background_image' => ($section['background_image']) ? $this->uploadEncoded64Image($section['background_image']) : null,
                        'is_parallax' => $section['is_parallax'],
                        'order' => $section['order'],
                    ], $background));

                    $projectSection->model->update(['body' => $section['model']['body']]);
                } elseif($section['component'] === 'ProjectTextInformation') {
                    if ((preg_match('/^data\:image/', $section['background_image']))) {
                        $background = [ 'background_image' => $this->uploadEncoded64Image($section['background_image']) ];
                    } else {
                        $background = ($section['background_image']) ? ['0'] : ['background_image' => null];
                    }

                    $attrs = [
                        'color' => $section['color'],
                        'is_dark' => $section['is_dark'],
                        //'background_image' => ($section['background_image']) ? $this->uploadEncoded64Image($section['background_image']) : null,
                        'is_parallax' => $section['is_parallax'],
                        'order' => $section['order'],
                    ];

                    $attrs = array_merge($attrs, $background);

                    $textInformationSection = ProjectTextInformation::create([
                        'project_id' => $project->id,
                        'body' => $section['model']['body'],
                    ]);

                    $project->addSection(ProjectTextInformation::class,  $textInformationSection->id, $attrs);
                }
            }
        } else {
            $project->sections()->delete();
        }

        return true;
    }
}
