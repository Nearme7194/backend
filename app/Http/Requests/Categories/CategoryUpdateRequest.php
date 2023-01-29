<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'string|min:3|max:15|unique:categories'
        ];
    }
}
