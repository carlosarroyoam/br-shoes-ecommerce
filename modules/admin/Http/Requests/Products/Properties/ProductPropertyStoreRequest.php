<?php

namespace Modules\Admin\Http\Requests\Products\Properties;

use Illuminate\Foundation\Http\FormRequest;

class ProductPropertyStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'unique:product_properties,name'],
        ];
    }
}
