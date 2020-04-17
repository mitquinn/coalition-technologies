<?php

namespace App\Rules;

use App\Models\Project;
use Auth;
use Illuminate\Contracts\Validation\Rule;

class ProjectNameCanNotBeDuplicatedForSameUser implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $userId = Auth::user()->getId();
        if (Project::whereName($value)->whereUserId($userId)->exists()) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'A project with this name already exists.';
    }
}
