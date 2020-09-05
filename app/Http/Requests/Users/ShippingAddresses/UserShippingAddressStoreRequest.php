<?php

namespace App\Http\Requests\Users\ShippingAddresses;

use Illuminate\Foundation\Http\FormRequest;

class UserShippingAddressStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => ['required', 'integer', 'gt:0'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
            'zip_code' => ['required', 'integer', 'gt:0'],
            'country' => ['required', 'string'],
        ];
    }
}
