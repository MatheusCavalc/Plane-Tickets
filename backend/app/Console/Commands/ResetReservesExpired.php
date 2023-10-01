<?php

namespace App\Console\Commands;

use App\Models\Reserve;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class ResetReservesExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reserves:reset'; //app:reset-reserves-expired

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete reserves e restore tickets to buy';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        $expiredReserves = Reserve::with('flight')->where('expiration', '<=', $now)->get();
        foreach ($expiredReserves as $reserve) {
            $flight = $reserve->flight;
            $flight->available_tickets++;
            $flight->save();
            $reserve->delete();
        }

        $this->info('Expired reserves deleted with succesful.');
    }
}
