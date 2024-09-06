<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class ClientLoanResource extends JsonResource
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
            'id' =>  $this->id,
            'enroll_id' =>  $this->enroll_id,
            'loan_id' =>  $this->loan_id,
            'creator' =>  $this->creator->name,
            'created_at' => $this->created_at,
        ];
    }
}
