<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price_per_night',
        'capacity'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}