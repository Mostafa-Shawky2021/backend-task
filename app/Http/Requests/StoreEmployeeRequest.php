<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $employee =  $this->route('employee');

        $validationRule = [
            'employee_name' => 'required|min:4',
            'employee_email' => [
                Rule::unique('employees')->ignore($employee->id ?? null), 'required', 'email'
            ],
            'company_id' => 'required',
            'employee_image' => 'sometimes|image'
        ];

        if (!request()->filled('old_password') || request()->filled('employee_password'))
            $validationRule['employee_password'] = 'required|min:4';

        return $validationRule;
    }
}
