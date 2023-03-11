<?php

namespace App\Http\Requests\Districts;

use App\Rules\ForeignKeyCheck;
use Illuminate\Foundation\Http\FormRequest;

class DistrictCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:15',
            'state_id' => ['required','integer',
            new ForeignKeyCheck('states', 'id')
            ]
        ];
    }
}
