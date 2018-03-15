<?php

namespace App\Http\Controllers\Api\v1;

use App\Client;
use App\Country;
use App\Http\Requests\ProjectRequest;
use App\Http\Controllers\Controller;
use App\Project;
use App\ProjectGallery;
use App\ProjectGalleryImage;
use App\ProjectQuote;
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
                array_merge(Schema::getColumnListing((new ProjectGalleryImage())->getTable()), ['images']),
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
            class_basename(ProjectQuote::class) => array_fill_keys(
                Schema::getColumnListing((new ProjectQuote())->getTable()),
                null
            ),
        ];

        $this->middleware('auth:api')->except(['index', 'show', 'getNextProject', 'showBySlug']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with('sections', 'country')->orderByDesc('is_featured')->get();

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
        foreach (['hero_image', 'hero_image_preview', 'hero_image_footer'] as $image) {
            if ($request->get($image)) {
                $request->offsetSet($image, $this->uploadEncoded64Image($request->get($image)));
            } else {
                $request->offsetUnset($image);
            }
        }

        //Create Project Model
        $project = Project::create($request->all());

        //Save services
        $services_ids = array_map(function($service){return $service['id'];}, $request->get('services'));
        $project->services()->sync($services_ids);

        //Process Project Sections
        $this->handleProjectSections($request, $project);

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
            'sections',
            'country'
        );

        return response()->json($project, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function showBySlug($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        $project->load(
            'client',
            'services',
            'sections',
            'country'
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
        $services_ids = array_map(function($service){return $service['id'];}, $request->get('services'));
        $project->services()->sync($services_ids);
        $request->offsetUnset('areas');
        $request->offsetUnset('services');

        //Process Project Sections
        $this->handleProjectSections($request, $project);

        //Upload Images
        foreach (['hero_image', 'hero_image_preview', 'hero_image_footer'] as $image) {
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
        $projectId = $project->id;
        $project->delete();

        //Response
        return response()->json([
            'success' => true,
            'message' => 'Project (ID: '.$projectId.') deleted successfully!',
        ], 200);
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
    protected function handleProjectSections(Request $request, Project $project)
    {
        //Skip if empty Sections
        if (empty($request->get('sections'))) {
            $project->sections()->delete();

            return true;
        }

        //Filter Removed Sections from Updated/New ones
        $sections = [
            'created' => array_filter($request->get('sections'), function($section) {
                return (!isset($section['visible']) and !$section['id']);
            }),
            'updated' => array_filter($request->get('sections'), function($section) {
                return (!isset($section['visible']) and $section['id']);
            }),
            'removed' => array_filter($request->get('sections'), function($section) {
                return (isset($section['visible']) and $section['id']);
            })
        ];

        //Step 1: Remove deleted/missing Sections
        $project->bulkRemoveSections(array_map(function ($section) { return $section['id']; }, $sections['removed']));

        //Step 2: Create New Sections
        $project->bulkCreateSections($sections['created'], $this->projectSections);

        //Step 3: Update Modified Sections
        $project->bulkUpdateSections($sections['updated'], $this->projectSections);

        return true;
    }
}
