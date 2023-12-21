<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest
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
            'company_id' => 'required',
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:50',
            'email' => 'required|email|unique:employees,id,'.$this->id,
            'contact' => 'required|numeric|digits:10|unique:employees,id,'.$this->id,
        ];
    }
}
