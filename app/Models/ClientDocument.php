<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientDocument extends Model
{
    use HasFactory;
    protected $table= 'client_documents';
    protected $guarded=[];
    public function client(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class,'enroll_id'); // will look for enroll_id in $table and id in ClientGRT model;
    }

}
