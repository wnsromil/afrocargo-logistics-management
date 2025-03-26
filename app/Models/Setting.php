<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'key', 'value', 'type', 'default_value'];

    // Decode JSON values if type is 'json'
    public function getValueAttribute($value)
    {
        return $this->type === 'json' ? json_decode($value, true) : $value;
    }

    // Encode JSON values before saving
    public function setValueAttribute($value)
    {
        $this->attributes['value'] = $this->type === 'json' ? json_encode($value) : $value;
    }

    // Decode JSON for default value
    public function getDefaultValueAttribute($value)
    {
        return $this->type === 'json' ? json_decode($value, true) : $value;
    }
}
