<?php

namespace App\Http\Requests\Products\Properties;

use Illuminate\Foundation\Http\FormRequest;

class ProductPropertyStoreRequest extends FormRequest
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
            'product_property_type_id' => ['required', 'integer', 'gt:0'],
            'value' => ['required', 'string'],
        ];
    }
}
