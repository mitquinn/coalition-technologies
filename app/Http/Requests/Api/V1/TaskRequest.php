<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\Api\BaseRequest;
use Auth;

/**
 * Class TaskRequest
 * @package App\Http\Requests\Api\V1
 */
class TaskRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (request()->isMethod('POST')) {
            return [
                'name' => 'required|string',
                'project_id' => 'required|integer|exists:projects,id'
            ];
        }

        return [
            'name' => 'required|string',
            'priority' => 'required|integer',
            'project_id' => 'required|integer|exists:projects,id'
        ];
    }
}
