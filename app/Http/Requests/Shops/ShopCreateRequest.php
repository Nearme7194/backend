<?php

namespace App\Http\Requests\Shops;

use App\Rules\ForeignKeyCheck;
use Illuminate\Foundation\Http\FormRequest;

class ShopCreateRequest extends FormRequest
{
    public function rules()
    {

        return [
            'name' => 'required|string|min:3|max:15',
            'contact_number' => 'required|integer|min:6',
            'open_24' => 'required|boolean',
            'open_time' => 'required_if:open_24,0',
            'close_time' => 'required_if:open_24,0',
            'category_id' => [
                'required', 'integer',
                new ForeignKeyCheck('districts', 'id')
            ],
            'sub_category' => 'present|array',
            'sub_category.*' => 'exists:categories,id|distinct',
            'address_id' =>[
                'required', 'integer',
                new ForeignKeyCheck('addresses', 'id')
            ],
            'location_id' => [
                'required', 'integer',
                new ForeignKeyCheck('locations', 'id')
            ],

        ];
    }
}
