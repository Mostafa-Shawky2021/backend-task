<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'employee_name' => 'required|min:4',
            'employee_email' => 'required|email',
            'employee_password' => 'required|min:4',
            'company_id' => 'required',
            'employee_image' => 'sometimes|image'
        ];
    }
}
