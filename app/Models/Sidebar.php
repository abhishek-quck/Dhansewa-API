<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sidebar extends Model
{
    protected $table='sidebar-menu';
    use HasFactory;
    protected $casts = [
        'links' => 'array'
    ];

    public function submenu():HasMany
    {
        return $this->hasMany(SidebarSubmenu::class,'menu_id','id');
    }
}
