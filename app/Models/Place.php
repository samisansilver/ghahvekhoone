<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'description',
        'country',
        'city',
        'address',
        'latitude',
        'longitude',
        'phone',
        'instagram',
    ];
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
