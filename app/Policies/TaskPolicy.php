<?php

namespace App\Policies;

use App\User;
use App\Models\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class TaskPolicy
 * @package App\Policies
 */
class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Task $task
     * @return mixed
     */
    public function view(User $user, Task $task)
    {
        if ($user->getId() == $task->getUserId()) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Task $task
     * @return mixed
     */
    public function update(User $user, Task $task)
    {
        if ($user->getId() == $task->getUserId()) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Task $task
     * @return mixed
     */
    public function delete(User $user, Task $task)
    {
        if ($user->getId() == $task->getUserId()) {
            return true;
        }
        return false;
    }

}
