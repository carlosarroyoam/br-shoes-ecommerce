<?php

namespace App\Http\Requests\Products\Properties;

use Illuminate\Foundation\Http\FormRequest;

class ProductPropertyUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'unique:product_properties,name'],
        ];
    }
}
