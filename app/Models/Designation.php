<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    protected $guarded=[];
    public $timestamps = false;
    protected function name():Attribute
    {
        return Attribute::make(
            get:fn($value)=> strtoupper($value),
        );
    }
}
