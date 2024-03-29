<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChangeProfileRequest extends FormRequest
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
            'name' => 'required|min:3|max:25',
            'email' =>  ['required','email',Rule::unique('users')->ignore(auth()->user()->id)],
            'phone' =>  ['required','numeric','digits:12','starts_with:998',Rule::unique('users')->ignore(auth()->user()->id)]
        ];
    }

    public function messages()
    {
        return parent::messages();
    }
}
