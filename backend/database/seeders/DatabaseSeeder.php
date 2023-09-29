<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Airport;
use App\Models\Company;
use App\Models\Flight;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
            'is_admin' => true
        ]);

        Airport::create([
            'name' => 'Fortaleza',
            'slug' => 'fortaleza'
        ]);

        Airport::create([
            'name' => 'Brasilia',
            'slug' => 'brasilia'
        ]);

        Airport::create([
            'name' => 'Rio de Janeiro',
            'slug' => 'rio-de-janeiro'
        ]);

        Company::create([
            'name' => 'Azul'
        ]);

        Flight::create([
            'departure_from' => 1,
            'departure_time' => '2023-09-28 08:00:00',
            'destination' => 2,
            'arrival_time' => '2023-09-28 10:00:00',
            'company_id' => 1,
            'available_tickets' => 10,
            'ticket_price' => 150.00,
        ]);

        Flight::create([
            'departure_from' => 1,
            'departure_time' => '2023-09-30 08:00:00',
            'destination' => 2,
            'arrival_time' => '2023-09-30 10:00:00',
            'company_id' => 1,
            'available_tickets' => 10,
            'ticket_price' => 200.00,
        ]);

        Flight::create([
            'departure_from' => 1,
            'departure_time' => '2023-09-30 08:00:00',
            'destination' => 3,
            'arrival_time' => '2023-09-30 10:00:00',
            'company_id' => 1,
            'available_tickets' => 10,
            'ticket_price' => 250.00,
        ]);

        Ticket::create([
            'flight_id' => 1,
            'user_id' => 1,
            'checkin' => false,
        ]);
    }
}
