<?php

namespace App\Http\Requests\Locations;

use Illuminate\Foundation\Http\FormRequest;

class LocationUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'latitude' => 'numeric|min:1|max:10|unique:locations',
            'longitude' => 'numeric|min:1|max:10|unique:locations',
            'zoom_level' => 'numeric|min:1|max:10|unique:locations'
        ];
    }
}
