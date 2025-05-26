<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContainerCompany extends Model
{
    protected $table = 'container_company'; // explicitly specify table
    protected $fillable = ['name', 'status'];
}
