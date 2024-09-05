<?php

namespace App\Models;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
class Employee extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $guarded=[];
    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Usually the primary key of the model
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public $timestamps = false;

    public function branch(): HasOne
    {
        return $this->hasOne(Branch::class,'id','branch');
    }

    protected function password():Attribute
    {
        return Attribute::make(
            set:fn($value)=> Hash::make($value)
        );
    }
    protected function dashboard():Attribute
    {
        return Attribute::make(
            set:fn($value)=> strtoupper($value),
            get:fn($value)=> strtoupper($value)
        );
    }
    protected function empType():Attribute
    {
        return Attribute::make(
            set:fn($value)=> strtoupper($value),
            get:fn($value)=> strtoupper($value)
        );
    }

}
