<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'string|min:3|max:15|unique:roles'
        ];
    }
}
