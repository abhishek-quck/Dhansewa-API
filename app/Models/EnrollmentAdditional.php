<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrollmentAdditional extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table='enrollment_additionals';

    protected $hidden = ['group_no','loan_request','enrolled_by'];
    protected function coApplicantDob():Attribute
    {
        return Attribute::make(
            get:fn($value)=> date('Y-m-d',strtotime($value))
        );
    }
}
