<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'icon', 'route', 'active', 'parent_id', 'order', 'roles', 'permissions'];

    protected $casts = [
        'roles' => 'array', // Convert JSON to array automatically
        'permissions' => 'array',
    ];

    public function submenu()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
    }
}
