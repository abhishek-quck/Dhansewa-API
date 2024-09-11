<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ledger extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table= 'client_ledger';
    protected $guarded= [];
    public function createdAt():Attribute
    {
        return Attribute::make(
            get:fn($value) => date('d-m-Y', strtotime($value))
        );
    }

    public function enrollment():BelongsTo
    {
        return $this->belongsTo(Enrollment::class, 'enroll_id' );
    }

    public function loan():BelongsTo
    {
        return $this->belongsTo(LoanDisbursement::class);
    }
}
