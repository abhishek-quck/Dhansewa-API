<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model,SoftDeletes};
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Collection extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $guarded=[];

    public function branch():BelongsTo
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }
}
