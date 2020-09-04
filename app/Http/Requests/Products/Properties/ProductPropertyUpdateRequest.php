<?php

namespace App\Http\Requests\Products\Properties;

use Illuminate\Foundation\Http\FormRequest;

class ProductPropertyUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => ['required', 'integer', 'gt:0'],
            'property_type_id' => ['required', 'integer', 'gt:0'],
            'value' => ['required', 'string'],
        ];
    }
}
