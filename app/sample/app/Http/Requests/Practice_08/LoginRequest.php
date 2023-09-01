<?php

namespace App\Http\Requests\Practice_08;

use App\Http\Requests\CommonRequest;

class LoginRequest extends CommonRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'employeeCode' => ['required ','string','max:10']
            ,'password' => ['required ','string','max:50']
        ];
    }
}
