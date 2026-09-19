<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'tagline',
        'description',
        'banner_image',
        'event_date',
        'end_date',
        'venue_name',
        'venue_address',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    }

    public function ticketTypes()
    {
        return $this->hasMany(TicketType::class)->orderBy('price', 'desc');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class)->latest();
    }
}
