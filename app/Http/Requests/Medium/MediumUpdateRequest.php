<?php

namespace App\Http\Requests\Medium;

use Illuminate\Foundation\Http\FormRequest;

class MediumUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'string|min:3|max:15|unique:media'
        ];
    }
}
