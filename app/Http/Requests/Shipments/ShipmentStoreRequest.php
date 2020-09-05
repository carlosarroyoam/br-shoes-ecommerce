<?php

namespace App\Http\Requests\Shipments;

use Illuminate\Foundation\Http\FormRequest;

class ShipmentStoreRequest extends FormRequest
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
            'shipment_status_id' => ['required', 'integer', 'gt:0'],
        ];
    }
}