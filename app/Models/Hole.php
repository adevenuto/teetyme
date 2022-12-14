<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hole extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'par',
        'number',
        'length_yds',
        'length_m',
        'teebox'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
