<?php

namespace App\Http\Requests;

use App\Http\Requests\CommonRequest;

class WorkRequest extends CommonRequest
{

    protected $redirect = 'xxx/index';
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
}
