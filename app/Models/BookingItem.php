<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'ticket_type_id',
        'ticket_code',
        'attendee_name',
        'price',
        'is_checked_in',
        'checked_in_at',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_checked_in' => 'boolean',
            'checked_in_at' => 'datetime',
        ];
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }
}
