<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'emp_type' => ['required'],
            'designation' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'phone' => ['required'],
            'branch' => ['required'],
            'access_branch' => ['required'],
            'address' => ['required'],
            'login_id' => ['required'],
            'password' => ['required'],
            'married' => [],
            'gender' => ['required'],
            'motorization' => [],
            'dashboard' => ['required'],
            'approval_limit' => ['required'],
            'dob' => ['required'],
            'app_login' => ['required'],
            'exit_date' => [],
            'join_date' => ['required'],
            'email' => [],
            'pan' => [],
            'aadhaar' => ['required'],
            'bank' => [],
            'bank_branch' => [],
        ];
    }
}
