<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ProductUpdateRequest extends FormRequest
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
            'slug' => ['nullable', 'string',],
            'description' => ['required', 'string',],
            'featured' =>['nullable', 'boolean',],
            'price_in_cents' => ['required', 'numeric',],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->slug ?? Str::slug($this->name);

        $this->merge([
            'slug' => $slug,
        ]);
    }
}
