<?php

namespace Modules\Admin\Http\Requests\Products\PropertyValues;

use Illuminate\Foundation\Http\FormRequest;

class ProductPropertyValueUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'value' => ['required', 'string'],
        ];
    }
}
