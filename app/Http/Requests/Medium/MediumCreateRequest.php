<?php

namespace App\Http\Requests\Medium;

use Illuminate\Foundation\Http\FormRequest;

class MediumCreateRequest extends FormRequest
{
    
    public function rules()
    {
       
        return [
            'name' => 'required|string|min:3|max:15|unique:media'
        ];
    }
}
