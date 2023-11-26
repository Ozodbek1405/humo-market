<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'price' => 'required|numeric|gt:0',
            'discount' => '',
            'description' => 'required|min:10',
            'title' => 'required|string|min:3|max:255',
            'images' => 'required|array|min:3',
            'color_id' => 'sometimes|array',
            'size_id' => 'sometimes|array',
            'shoe_size_id' => 'sometimes|array',
            'brand_id' => 'required',
            'parent_category_id' => 'required',
            'child_category_id' => 'required',
            'count' => 'required',
            'dimensions' => '',
            'weight' => '',
            'materials' => '',
        ];
    }

    public function messages()
    {
        return parent::messages();
    }
}
