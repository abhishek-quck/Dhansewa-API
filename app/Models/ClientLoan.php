<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientLoan extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $guarded=[];

    public function enrolled():BelongsTo
    {
        return $this->belongsTo(Enrollment::class, 'enroll_id');
    }

    public function createdAt():Attribute
    {
        return Attribute::make(
            get:fn($value)=>date('d-m-Y', strtotime($value))
        );
    }

    public function creator(){
        return $this->belongsTo(User::class,'updated_by');
    }

}
