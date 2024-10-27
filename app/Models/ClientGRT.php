<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClientGRT extends Model
{
    use HasFactory;
    protected $table='client_grt';
    protected $primaryKey = 'client_id';
    protected $guarded=[];
    public $timestamps=false;

    public function grtDate():Attribute
    {
        return Attribute::make(
            get:fn($value)=> date('d-m-Y',strtotime($value))
        );
    }

    public function enrolled():BelongsTo
    {
        return $this->belongsTo(Enrollment::class, 'enroll_id');
    }
}
