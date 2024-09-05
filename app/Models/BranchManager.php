<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchManager extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected function name():Attribute
    {
        return Attribute::make(
            get:fn($v)=>ucwords($v),
            set:fn($v)=>ucwords($v)
        );
    }

    protected function email():Attribute
    {
        return Attribute::make(
            get:fn($v)=>strtolower($v),
            set:fn($v)=>strtolower($v)
        );
    }
}
