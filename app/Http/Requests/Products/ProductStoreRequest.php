<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ProductStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string',],
            'slug' => ['nullable', 'string', 'max:96', 'unique:categories', ],
            'description' => ['required', 'string',],
            'featured' =>['nullable', 'boolean',],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => $this->slug ?? Str::slug($this->name),
        ]);
    }
}
