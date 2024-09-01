<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_id',
        'date',
        'description',
        'image1',
        'image2',
        'image3',
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function stops()
    {
        return $this->hasMany(Stop::class);
    }
}