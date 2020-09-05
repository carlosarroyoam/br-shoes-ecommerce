<?php

namespace App\Http\Requests\Orders\OrderDetails;

use Illuminate\Foundation\Http\FormRequest;

class OrderDetailUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_variant_id' => ['required', 'integer', 'gt:0'],
            'quantity' => ['required', 'integer', 'gt:0'],
        ];
    }
}
