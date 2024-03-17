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
            'name_uz' => 'required|string|min:3|max:255',
            'name_en' => 'required|string|min:3|max:255',
            'price' => 'required|numeric|gt:0',
            'discount' => '',
            'desc_uz' => 'required|min:10',
            'desc_en' => 'required|min:10',
            'title' => 'required|string|min:3|max:255',
            'images' => 'sometimes|array|min:3',
            'color_id' => 'sometimes|array',
            'size_id' => 'sometimes|array',
            'shoe_size_id' => 'sometimes|array',
            'brand_id' => 'required',
            'category_id' => 'required',
            'parent_category_id' => 'required',
            'child_category_id' => 'required',
            'count' => 'required',
            'dimensions' => '',
            'weight' => '',
            'materials' => '',
            'company_id' => 'required',
            'characteristic_id' => 'required',
        ];
    }

    public function messages()
    {
        return parent::messages();
    }
}
