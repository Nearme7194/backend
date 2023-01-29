<?php

namespace App\Http\Requests\Locations;

use Illuminate\Foundation\Http\FormRequest;

class LocationCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'latitude' => 'required|numeric|min:1|max:10|unique:locations',
            'longitude' => 'required|numeric|min:1|max:10|unique:locations',
            'zoom_level' => 'required|numeric|min:1|max:10|unique:locations'
        ];
    }
}
