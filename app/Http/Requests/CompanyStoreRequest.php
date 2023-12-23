<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:25|unique:companies',
            'email' => 'required|email|unique:companies',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:ratio=1/1',
            'company_website' => 'required|url',
        ];

    }
    public function messages()
    {
        return [
            'logo.dimensions'=>'Image should be square'
        ];
    }
}
