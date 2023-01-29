<?php

namespace App\Http\Requests\States;

use Illuminate\Foundation\Http\FormRequest;

class StateCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:15|unique:states'
        ];
    }
}
