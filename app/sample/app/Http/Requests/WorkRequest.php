<?php

namespace App\Http\Requests;

use App\Http\Requests\CommonRequest;

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
            'startTime' => ['required ', 'date_format:H:i']
            , 'endTime' => ['required ', 'date_format:H:i']
            , 'details' => ['required ', 'string', 'max:200']

        ];
    }
}
