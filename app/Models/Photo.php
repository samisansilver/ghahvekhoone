<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'place_id'
    ];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
