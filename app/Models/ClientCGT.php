<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientCGT extends Model
{
    use SoftDeletes;
    protected $guarded=[];
    protected $table = 'client_cgt';
    use HasFactory;

    public function enrollment():BelongsTo
    {
        return $this->belongsTo(Enrollment::class, 'enroll_id');
    }

}
