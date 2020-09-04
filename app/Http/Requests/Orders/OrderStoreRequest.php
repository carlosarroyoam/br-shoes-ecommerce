<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            'user_id' => ['required', 'integer', 'gt:0'],
            'shipment_id' => ['required', 'integer', 'gt:0'],
            'order_status_id' => ['required', 'integer', 'gt:0'],
            'comments' => ['string'],
        ];
    }
}
