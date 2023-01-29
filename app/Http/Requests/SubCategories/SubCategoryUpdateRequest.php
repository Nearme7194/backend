<?php

namespace App\Http\Requests\SubCategories;

use App\Rules\ForeignKeyCheck;
use Illuminate\Foundation\Http\FormRequest;

class SubCategoryUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => '|string|min:3|max:15',
            'category_id' => ['required','integer',
            new ForeignKeyCheck('categories', 'id')
            ]
        ];
    }
}
