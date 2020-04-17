<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\Api\BaseRequest;
use Auth;

/**
 * Class ProjectRequest
 * @package App\Http\Requests\Api\V1
 */
class ProjectRequest extends BaseRequest
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
        return [
            'name' => 'required|string',
        ];
    }
}
