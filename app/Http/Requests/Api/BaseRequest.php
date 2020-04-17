<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    /** @var Validator $validator */
    protected $validator = null;

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $this->setValidator($validator);
    }

    /**
     * @return Validator
     */
    public function getValidator(): Validator
    {
        if(is_null($this->validator)) {
            $this->validator = $this->getValidatorInstance();
        }
        return $this->validator;
    }

    /**
     * @param Validator $validator
     * @return BaseRequest
     */
    public function setValidator(Validator $validator): BaseRequest
    {
        $this->validator = $validator;
        return $this;
    }
}
