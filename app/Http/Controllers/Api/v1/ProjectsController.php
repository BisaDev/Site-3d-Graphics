<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\ProjectRequest;
use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

/**
 * Class ProjectsController
 * @package App\Http\Controllers\Api\v1
 */
class ProjectsController extends Controller
{
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
        $request->offsetSet('country_id', 1);
        $request->offsetSet('client_id', 1);

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

        //Response
        return response()->json([
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
        return response()->json($project, 200);
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

        //Response
        return response()->json([
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
}
