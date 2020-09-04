<?php

namespace App\Http\Requests\Users\ContactDetails;

use Illuminate\Foundation\Http\FormRequest;

class UserContactDetailStoreRequest extends FormRequest
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
            'user_id' => ['required', 'integer', 'gt:0', 'unique:user_contact_details,user_id'],
            'phone_number' => ['required', 'string', 'max:10', 'unique:user_contact_details,phone_number'],
        ];
    }
}
