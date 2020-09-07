<?php

namespace App\Http\Requests\Products\PropertyTypes;

use Illuminate\Foundation\Http\FormRequest;

class ProductPropertyTypeUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'unique:product_property_types,name'],
        ];
    }
}
