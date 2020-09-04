<?php

namespace App\Http\Requests\ShoppingBag;

use Illuminate\Foundation\Http\FormRequest;

class ShoppingBagUpdateRequest extends FormRequest
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
            'user_id' => ['required', 'integer', 'gt:0', 'unique:shopping_bags,user_id'],
        ];
    }
}
