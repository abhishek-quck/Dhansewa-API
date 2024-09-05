<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Branch extends Model
{
    use HasFactory;
    protected $table= 'branches';
    protected $guarded=[];

    protected function name():Attribute
    {
        return Attribute::make(
            get:fn($value)=> ucwords($value),
            set:fn($value)=> ucwords($value)
        );
    }

    protected function reportingMail():Attribute
    {
        return Attribute::make(
            get:fn($value)=> strtolower($value),
            set:fn($value)=> strtolower($value)
        );
    }

    public function centers():HasMany
    {
        return $this->hasMany(Center::class,'branch_id','id');
    }
    public function clients():HasMany
    {
        return $this->hasMany(Enrollment::class,'branch_id','id');
    }

    public function clientsWithGrt():HasMany
    {
        return $this->hasMany(Enrollment::class,'branch_id','id');
    }

    public function company():HasOne
    {
        return $this->hasOne(Company::class,'id', 'company_id');
    }
}
