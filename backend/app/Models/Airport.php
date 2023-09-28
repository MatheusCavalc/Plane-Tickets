<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function departureFlights()
    {
        return $this->hasMany(Flight::class, 'departure_from', 'id');
    }

    public function destinationFlights()
    {
        return $this->hasMany(Flight::class, 'destination', 'id');
    }
}
