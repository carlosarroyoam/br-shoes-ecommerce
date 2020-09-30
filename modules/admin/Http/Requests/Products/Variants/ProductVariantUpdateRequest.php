<?php

namespace Modules\Admin\Http\Requests\Products\Variants;

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
            'price' => ['nullable', 'integer'],
            'compared_at_price' => ['nullable', 'integer'],
            'cost_per_item' => ['nullable', 'integer'],
            'quantity_on_stock' => ['nullable', 'integer'],
        ];
    }
}
