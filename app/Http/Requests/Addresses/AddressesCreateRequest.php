<?php

namespace App\Http\Requests\Addresses;

use App\Rules\ForeignKeyCheck;
use Illuminate\Foundation\Http\FormRequest;

class AddressesCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'body' => 'required|string|min:3|max:15',
            'pincode' => 'required|integer|min:6',
            'state_id' => [
                'required', 'integer',
                new ForeignKeyCheck('states', 'id')
            ],
            'district_id' => [
                'required', 'integer',
                new ForeignKeyCheck('districts', 'id')
            ],
            'tehasil_id' => [
                'required', 'integer',
                new ForeignKeyCheck('districts', 'id')
            ]
        ];
    }
}
