<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Account extends Model
{
    use HasFactory;
    protected $table= 'accounts';
    protected $guarded=[];

    public function head():HasOne
    {
        return $this->hasOne(AccountHead::class, 'id', 'ob_head_id');
    }
}
