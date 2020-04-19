<?php

namespace App\Http\Controllers\Api\V1;

use Log;
use Exception;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\ApiController;

/**
 * Class ProjectTaskController
 * @package App\Http\Controllers\Api\V1
 */
class ProjectTaskController extends ApiController
{

    /**
     * @param Project $project
     * @return JsonResponse
     */
    public function projectTask(Project $project)
    {
        try {
            $project->tasks;
            return $this->success($project);
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
            return $this->error();
        }
    }
}
