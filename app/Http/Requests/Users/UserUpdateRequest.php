<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'email_verified_at' => ['nullable'],
            'password' => ['required', 'password'],
            'is_admin' => ['nullable', 'boolean'],
            'remember_token' => ['nullable', 'string', 'max:100'],
        ];
    }
}
