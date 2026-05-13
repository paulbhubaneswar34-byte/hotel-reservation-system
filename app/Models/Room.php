<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
    'room_type_id',
    'room_number',
    'is_available',
    'image',
];

    public function roomType()
{
    return $this->belongsTo(\App\Models\RoomType::class);
}

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}