<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stop extends Model
{
    use HasFactory;

    protected $fillable = [
        'day_id',
        'name',
        'description',
        'image1',
        'image2',
        'image3',
    ];

    public function day()
    {
        return $this->belongsTo(Day::class);
    }
}