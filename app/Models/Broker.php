<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Broker extends Model
{
    protected $table = 'broker'; // explicitly specify table
    protected $fillable = ['name', 'status'];
}

