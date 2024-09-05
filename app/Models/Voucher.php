<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Voucher extends Model
{
    use HasFactory;
    protected $guarded=[];

    public $timestamps=false;

    public function account():HasMany
    {
        return $this->hasMany(Account::class, 'id', 'account');
    }

}
