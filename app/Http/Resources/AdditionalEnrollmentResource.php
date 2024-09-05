<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdditionalEnrollmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'full_address'                  => "Door No.{$this->door_num}, crossing-{$this->crossing}, street-{$this->street} near {$this->landmark}",
            'alt_phone'                     => $this->alt_phone,
            'marital_status'                => $this->marital_status,
            'education'                     => $this->education,
            'religion'                      => $this->religion,
            'category'                      => $this->category,
            'ifsc'                          => $this->ifsc,
            'bank'                          => $this->bank,
            'bank_branch'                   => $this->bank_branch,
            'account_num'                   => $this->account_num,
            'nominee'                       => $this->nominee,
            'nominee_dob'                   => $this->nominee_dob,
            'nominee_relation'              => $this->nominee_relation,
            'nominee_aadhaar'               => $this->nominee_aadhaar,
            'nominee_kyc_type'              => $this->nominee_kyc_type,
            'nominee_kyc'                   => $this->nominee_kyc,
            'co_applicant'                  => $this->co_applicant,
            'co_applicant_rel'              => $this->co_applicant_rel,
            'co_applicant_dob'              => $this->co_applicant_dob,
            'co_applicant_industry_type'    => $this->co_applicant_industry_type,
            'co_applicant_job_type'         => $this->co_applicant_job_type,
            'co_applicant_income_freq'      => $this->co_applicant_income_freq,
            'member_in_family'              => $this->member_in_family,
            'mature_in_family'              => $this->mature_in_family,
            'minor_in_family'               => $this->minor_in_family,
            'earning_person_in_family'      => $this->earning_person_in_family,
            'depend_person_in_family'       => $this->depend_person_in_family,
            'house_land'                    => $this->house_land,
            'house_type'                    => $this->house_type,
            'total_land'                    => $this->total_land,
            'allied_activities'             => $this->allied_activities,
            'total_monthly_income'          => $this->total_monthly_income,
            'monthly_expenses'              => $this->monthly_expenses,
            'type'                          => $this->type,
            'email'                         => $this->email,
            'guarantor'                     => $this->guarantor,
            'pan'                           => $this->pan,
            'loan_request'                  => $this->loan_request,
            'enrolled_by'                   => $this->enrolled_by,
        ];
    }
}
