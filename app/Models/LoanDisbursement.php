<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanDisbursement extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $table = 'loan_disbursements';

    public function client():BelongsTo
    {
        return $this->belongsTo(Enrollment::class,'enroll_id');
    }

    public function createdAt():Attribute
    {
        return Attribute::make(
          get:fn($value)=> date('Y-m-d',strtotime($value))
        );
    }

}
