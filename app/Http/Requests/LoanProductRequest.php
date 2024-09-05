<?php

namespace App\Http\Requests;

use Error;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Contracts\Container\Container ;

class LoanProductRequest extends FormRequest
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
            'name'=>[],
            'installments' => [],
            'product_type' => [],
            'emi_frequency' => [],
            'intro_date' => [],
            'flat_rate' => [],
            'gst_tax' => [],
            'risk_fund' => [],
            'up_front_fee' => [],
            'linked_ac_number' => [],
            'cb_check' => [],
            'reducing_rate' => [],
            'category' => [],
            'repay_pattern' => [],
            'month_tenure' => [],
            'year_tenure' => [],
            'removal_date' => [],
            'comments' => []
        ];
    }
}
