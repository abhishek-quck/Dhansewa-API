<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientLoan extends Model
{
    use HasFactory;

    public function enrolled():BelongsTo
    {
        return $this->belongsTo(Enrollment::class, 'enroll_id');
    }

}
