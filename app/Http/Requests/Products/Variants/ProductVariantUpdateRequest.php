<?php

namespace App\Http\Requests\Products\Variants;

use Illuminate\Foundation\Http\FormRequest;

class ProductVariantUpdateRequest extends FormRequest
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
            'price_in_cents' => ['required', 'integer', 'gt:0'],
            'is_master' => ['required'],
        ];
    }
}
