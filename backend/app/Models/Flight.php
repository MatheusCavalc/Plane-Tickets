<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'departure_from',
        'departure_time',
        'destination',
        'arrival_time',
        'company_id',
        'available_tickets',
        'ticket_price',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function departureAirport()
    {
        return $this->belongsTo(Airport::class, 'departure_from', 'id');
    }

    public function destinationAirport()
    {
        return $this->belongsTo(Airport::class, 'destination', 'id');
    }

    public function reserves()
{
    return $this->hasMany(Reserve::class);
}
}
