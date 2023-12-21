<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
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
            'name' => 'required|max:25|unique:companies,id,' . $this->id,
            'email' => 'required|email|unique:companies,id,' . $this->id,
            'logo' => 'nullable|dimensions:min_width=250,min_height=250|image|mimes:jpeg,png,jpg,gif|size:2048',
            'company_website' => 'required|url',
        ];
    }
}
