<?php

namespace App\Http\Requests\Practice_07;

use App\Http\Requests\CommonRequest;
use Illuminate\Contracts\Validation\Validator;

class GetWorkInfoRequest extends CommonRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'month' => ['required']
        ];
    }

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
