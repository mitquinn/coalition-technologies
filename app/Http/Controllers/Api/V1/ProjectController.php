<?php

namespace App\Http\Controllers\Api\V1;

use Log;
use Exception;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\V1\ProjectRequest;

/**
 * Class ProjectController
 * @package App\Http\Controllers\Api\V1
 */
class ProjectController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $user = auth()->user();
            $projects = $user->projects;
            return $this->success($projects);
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
            return $this->error();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectRequest $request
     * @return JsonResponse
     */
    public function store(ProjectRequest $request)
    {

        try {
            if ($request->getValidator()->fails()) {
                return $this->badRequest($request->getValidator()->errors());
            }
            $project = Project::create($request->validated());
            return $this->success($project);
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
            return $this->error();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return JsonResponse
     */
    public function show(Project $project)
    {
        try {
            return $this->success($project);
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
            return $this->error();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProjectRequest $request
     * @param Project $project
     * @return JsonResponse
     */
    public function update(ProjectRequest $request, Project $project)
    {
        try {
            if ($request->getValidator()->fails()) {
                return $this->badRequest($request->getValidator()->errors());
            }

            $project->update($request->validated());
            return $this->success($project);
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
            return $this->error();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return JsonResponse
     */
    public function destroy(Project $project)
    {
        try {
            $project->delete();
            return $this->deleted();
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
            return $this->error();
        }
    }
}
