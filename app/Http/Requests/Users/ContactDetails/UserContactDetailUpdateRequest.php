<?php

namespace App\Http\Requests\Users\ContactDetails;

use Illuminate\Foundation\Http\FormRequest;

class UserContactDetailUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone_number' => ['required', 'string', 'max:10', 'unique:user_contact_details'],
        ];
    }
}
