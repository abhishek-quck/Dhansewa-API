<?php

namespace App\Http\Requests;

use Error;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class VoucherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        // $exception = $validator->getException();
        throw new Error('validation failed');
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'branch_id' => ['required'],
            'date'      => ['required'],
            'type'      => ['required'],
            'narration' => ['required'],
            'credit'    => ['required'],
            'debit'     => ['required'],
            'amount'    => ['required'],
            'account'   => ['required'],
        ];
    }
}
