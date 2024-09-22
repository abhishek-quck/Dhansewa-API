<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected function leaderName():Attribute
    {
        return Attribute::make(
            get:fn($value)=>ucwords($value),
            set:fn($value)=>ucwords($value)
        );
    }
    // protected function meetingDays():Attribute
    // {
    //     return Attribute::make(
    //         get:fn($value)=>ucwords($value),
    //     );
    // }
    protected function branch():Attribute
    {
        return Attribute::make(
            get:fn($value)=> ucwords($value),
            set:fn($value)=> ucwords($value)
        );
    }

    public function itsBranch()
    {
        return $this->belongsTo(Branch::class,'branch_id','id'); // foreign_key, primary_key (in this case:`branch_id`- in centers table, 'id'- in branches table)
    }

    public function enrolls():HasMany 
    {
        return $this->belongsTo(Enrollment::class, 'center_id','id');
    }
}
