<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'description',
        'price',
        'total_quantity',
        'available_quantity',
        'badge',
        'color',
        'perks',
        'max_per_order',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'perks' => 'array',
            'total_quantity' => 'integer',
            'available_quantity' => 'integer',
            'max_per_order' => 'integer',
        ];
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function bookingItems()
    {
        return $this->hasMany(BookingItem::class);
    }

    public function isSoldOut(): bool
    {
        return $this->available_quantity <= 0;
    }
}
