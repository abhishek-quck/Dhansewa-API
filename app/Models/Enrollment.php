<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasOne,HasMany,HasOneThrough,HasManyThrough};

class Enrollment extends Model
{
    use HasFactory;
    protected $table='enrollments';
    // protected $with = ['latestDocument'];
    protected $guarded=[];

    protected function state():Attribute
    {
        return Attribute::make(
            get:fn($value)=> ucwords($value),
            set:fn($value)=> ucwords($value)
        );
    }
    protected function applicantName():Attribute
    {
        return Attribute::make(
            get:fn($value)=> ucwords($value),
            set:fn($value)=> ucwords($value)
        );
    }
    protected function createdAt():Attribute
    {
        return Attribute::make(
            get:fn($value)=> date('d-m-Y',strtotime($value))
        );
    }

    // public function documents():HasManyThrough
    // {
    //     return $this->hasManyThrough(ClientDocument::class,ClientGRT::class,'enroll_id','enroll_id','id','enroll_id');
    // }

    public function documents():HasMany
    {
        return $this->hasMany(ClientDocument::class, 'enroll_id');
    }
    public function latestDocument():HasOneThrough
    {
        return $this->HasOneThrough(ClientDocument::class,ClientGRT::class,'enroll_id','enroll_id','id','enroll_id')->latest();
    }

    public function branch():HasOne
    {
        return $this->hasOne(Branch::class,'id','branch_id');
    }
    public function center():HasOne
    {
        return $this->hasOne(Center::class,'id','center_id');
    }

    public function loan():HasMany
    {
        return $this->hasMany(LoanDisbursement::class,'enroll_id','id');
    }

    public function cgt():HasOne
    {
        return $this->hasOne(ClientCGT::class,'enroll_id');
    }
    public function grt():HasOne
    {
        return $this->hasOne(ClientGRT::class,'enroll_id');
    }

    public function otherInfo():HasOne
    {
        return $this->hasOne(EnrollmentAdditional::class,'enroll_id');
    }

    public function appraisal():HasOne
    {
        return $this->hasOne(CreditAppraisal::class, 'enroll_id');
    }

    public function loanInfo():HasMany
    {
        return $this->hasMany(ClientLoan::class, 'enroll_id');
    }

    public function sanction():HasMany
    {
        return $this->hasMany(SanctionLetter::class, 'enroll_id');
    }

}
