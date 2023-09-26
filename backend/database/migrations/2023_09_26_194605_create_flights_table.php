<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('departure_from'); //airport
            $table->time('departure_time');
            $table->unsignedBigInteger('destination'); //airport
            $table->time('arrival_time');
            $table->foreignId('company_id')->constrained();
            $table->integer('available_tickets');
            $table->decimal('ticket_price', 8, 2);
            $table->timestamps();

            $table->foreign('departure_from')->references('id')->on('airports');
            $table->foreign('destination')->references('id')->on('airports');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
