<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class SanctionLetter extends Model
{
    protected $guarded=[];
    public $timestamps = false;

    public function date():Attribute
    {
        return Attribute::make(
            get:fn($value)=> date('d-m-Y', strtotime($value))
        );
    }
}
