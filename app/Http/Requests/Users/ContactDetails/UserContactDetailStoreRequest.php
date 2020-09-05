<?php

namespace App\Http\Requests\Users\ContactDetails;

use Illuminate\Foundation\Http\FormRequest;

class UserContactDetailStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => ['required', 'integer', 'gt:0', 'unique:user_contact_details,user_id'],
            'phone_number' => ['required', 'string', 'max:10', 'unique:user_contact_details'],
        ];
    }
}
