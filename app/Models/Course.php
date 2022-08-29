<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function holes()
    {
        return $this->hasMany(Hole::class);
    }

    public function teebox($name=null)
    {
        return $this->holes->where('teebox', $name);
    }
}
