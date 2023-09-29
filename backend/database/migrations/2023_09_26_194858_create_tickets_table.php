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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flight_id')->constrained(); // Chave estrangeira para o voo
            $table->foreignId('user_id')->constrained(); // Chave estrangeira para o dono da passagem
            $table->boolean('checkin')->default(false);

            $table->string('status_payment')->default('PENDING');

            //PAYMENT ID (ON STRIPE)
            //$table->longText('stripe_payment_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
