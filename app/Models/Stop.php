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
    ];

    public function day()
    {
        return $this->belongsTo(Day::class);
    }
}