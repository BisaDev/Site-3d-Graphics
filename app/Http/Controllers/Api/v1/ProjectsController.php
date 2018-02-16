<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\ProjectRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Project;

/**
 * Class ProjectsController
 * @package App\Http\Controllers\Api\v1
 */
class ProjectsController extends Controller
{
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
        $projects = Project::orderByDesc('is_featured')->get();

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
        $request->offsetSet('hero_image', 'image.png');
        $request->offsetSet('hero_image_preview', 'image.png');
        $request->offsetSet('country_id', 1);
        $request->offsetSet('client_id', 1);

        $project = Project::create($request->all());

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
        $project->update($request->all());

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
        $allProjects = Project::orderByDesc('is_featured')->get();

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
}
