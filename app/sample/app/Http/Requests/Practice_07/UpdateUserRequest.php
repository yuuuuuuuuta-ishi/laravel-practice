<?php

namespace App\Http\Requests\Practice_07;

use App\Http\Requests\CommonRequest;
use Illuminate\Contracts\Validation\Validator;

class UpdateUserRequest extends CommonRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'code' => ['required', 'string']
            , 'name' => ['required' , 'string']
            , 'age' => ['required', 'integer']
            , 'branch' => ['required', 'string']
            , 'department' => ['required' , 'string']
            , 'post' => ['required' , 'string']
            , 'entryDate' => ['required' , 'string']
        ];
    }
}
