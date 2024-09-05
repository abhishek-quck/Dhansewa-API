<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected function name():Attribute
    {
        return Attribute::make(
            set:fn($v)=>ucwords($v),
            get:fn($v)=>ucwords($v)
        );
    }
}
