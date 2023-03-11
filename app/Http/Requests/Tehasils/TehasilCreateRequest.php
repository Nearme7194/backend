<?php

namespace App\Http\Requests\Tehasils;

use App\Rules\ForeignKeyCheck;
use Illuminate\Foundation\Http\FormRequest;

class TehasilCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:15',
            'state_id' => [
                'required', 'integer',
                new ForeignKeyCheck('states', 'id')
            ],
            'district_id' => [
                'required', 'integer',
                new ForeignKeyCheck('districts', 'id')
            ]
        ];
    }
}
