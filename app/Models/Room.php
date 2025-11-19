<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'image',
        'capacity',
        'room_type',
        'available',
        'amenities',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'available' => 'boolean',
        'capacity' => 'integer',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
