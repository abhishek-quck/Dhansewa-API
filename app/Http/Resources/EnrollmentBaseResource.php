<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnrollmentBaseResource extends JsonResource
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
            'id'                => $this->id,
            'enc'               => encrypt($this->id),
            'aadhaar'           => $this->aadhaar,
            'applicant_name'    => $this->applicant_name,
            'relation'          => $this->relation,
            'relative_name'     => $this->relative_name,
            'gender'            => $this->gender,
            'PAN'               => $this->PAN,
            'postal_pin'        => $this->postal_pin,
            'village'           => $this->village,
            'center_id'         => $this->center_id,
            'district'          => $this->district,
            'state'             => $this->state,
            'date_of_birth'     => $this->date_of_birth,
            'phone'             => $this->phone,
        ];
    }
}
