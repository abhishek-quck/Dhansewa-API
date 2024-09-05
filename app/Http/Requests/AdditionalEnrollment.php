<?php

namespace App\Http\Requests;

use Error;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Contracts\Container\Container ;

class AdditionalEnrollment extends FormRequest
{
    public $validator = null;

    public function setValidator(Validator $validator)
    {
        $this->validator = $validator;

        return $this;
    }
     /**
     * Set the container implementation.
     *
     * @param  \Illuminate\Contracts\Container\Container  $container
     * @return $this
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;

        return $this;
    }

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
            //
            'enroll_id' => [],
            'door_num' => [],
            'crossing' => [],
            'street' => [],
            'landmark' => [],
            'alt_phone' => [],
            'marital_status' => [],
            'education' => [],
            'religion' => [],
            'category' => [],
            'ifsc' => [],
            'bank' => [],
            'bank_branch' => [],
            'account_num' => [],
            'is_debit_card' => [],
            'is_account_active' => [],
            'nominee' => [],
            'nominee_dob' => [],
            'nominee_relation' => [],
            'nominee_aadhaar' => [],
            'nominee_kyc_type' => [],
            'nominee_kyc' => [],
            'co_applicant' => [],
            'co_applicant_rel' => [],
            'co_applicant_dob' => [],
            'co_applicant_industry_type' => [],
            'co_applicant_job_type' => [],
            'co_applicant_income_freq' => [],
            'member_in_family' => [],
            'mature_in_family' => [],
            'minor_in_family' => [],
            'earning_person_in_family' => [],
            'depend_person_in_family' => [],
            'house_land' => [],
            'house_type' => [],
            'durable_access' => [],
            'is_lpg' => [],
            'total_land' => [],
            'allied_activities' => [],
            'farmer_category' => [],
            'total_monthly_income' => [],
            'monthly_expenses' => [],
            'type' => [],
            'email' => [],
            'guarantor' => [],
        ];
    }
}
