<?php

namespace App\Http\Requests\WishList;

use Illuminate\Foundation\Http\FormRequest;

class WishListUpdateRequest extends FormRequest
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
            'user_id' => ['required', 'integer', 'gt:0', 'unique:wish_lists,user_id'],
        ];
    }
}
