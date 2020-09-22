<?php

namespace App\Http\Requests\Products\PropertyValues;

use Illuminate\Foundation\Http\FormRequest;

class ProductPropertyValueStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => ['required', 'integer', 'gt:0'],
            'product_property_id' => ['required', 'integer', 'gt:0'],
            'value' => ['required', 'string'],
        ];
    }
}
