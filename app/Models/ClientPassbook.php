<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientPassbook extends Model
{
    use HasFactory;
    protected $guarded=[];
    public $timestamps=false;

    public function enrollment():BelongsTo
    {
        return $this->belongsTo(Enrollment::class, 'enroll_id' );
    }
}
