<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\V1\TaskRequest;
use App\Models\Task;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Log;

/**
 * Class TaskController
 * @package App\Http\Controllers\Api\V1
 */
class TaskController extends ApiController
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
            $tasks = $user->tasks;
            return $this->success($tasks);
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
            return $this->error();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TaskRequest $request
     * @return JsonResponse
     */
    public function store(TaskRequest $request)
    {
        try {
            if ($request->getValidator()->fails()) {
                return $this->badRequest($request->getValidator()->errors());
            }
            $task = Task::create($request->validated());
            return $this->success($task);
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
            return $this->error();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Task $task
     * @return JsonResponse
     */
    public function show(Task $task)
    {
        try {
            return $this->success($task);
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
            return $this->error();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Task $task
     * @return JsonResponse
     */
    public function update(TaskRequest $request, Task $task)
    {
        try {
            if ($request->getValidator()->fails()) {
                return $this->badRequest($request->getValidator()->errors());
            }

            $task->update($request->validated());
            return $this->success($task);
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
            return $this->error();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @return JsonResponse
     */
    public function destroy(Task $task)
    {
        try {
            $task->delete();
            return $this->deleted();
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
            return $this->error();
        }
    }
}
