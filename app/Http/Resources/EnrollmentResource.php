<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class EnrollmentResource extends JsonResource
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
            'aadhaar'           => $this->aadhaar,
            'applicant_name'    => $this->applicant_name,
            'relation'          => $this->relation,
            'relative_name'     => $this->relative_name,
            'gender'            => $this->gender,
            'PAN'               => $this->PAN,
            'postal_pin'        => $this->postal_pin,
            'village'           => $this->village,
            'district'          => $this->district,
            'state'             => $this->state,
            'date_of_birth'     => $this->date_of_birth,
            'phone'             => $this->phone,
            'branch'            => new BranchResource($this->branch),
            'other_info'        => new AdditionalEnrollmentResource($this->otherInfo),
            'documents'         => new Collection($this->documents)
        ];
    }
}
