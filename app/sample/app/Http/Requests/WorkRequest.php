<?php

namespace App\Http\Requests;

use App\Http\Requests\CommonRequest;
use Illuminate\Contracts\Validation\Validator;

class WorkRequest extends CommonRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'startTime' => ['required ']
            , 'endTime' => ['required ']
            , 'details' => ['required ', 'string', 'max:200']

        ];
    }

            //

    /**
     * リダイレクト先をcontrollerで指定のためfailedValidationをoverride
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
    }

    /**
     * @return  Validator  $validator
     */
    public function getValidator()
    {
        return $this->getValidatorInstance();
    }
}
