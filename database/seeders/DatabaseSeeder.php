<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Voucher;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class DatabaseSeeder extends Seeder
{
    /**
     * Usamos el factory de clientes para crear 20 de ellos, cada uno con 4 vouchers 
     *
     * @return void
     */
    public function run()
    {
        Client::factory(20)->create()->each(function ($client) {

            for ($i = 0; $i < 4; $i++) { 
                
                Voucher::create([
                    'client_id'    => $client->id,
                    'topic'        => Arr::random(['transfers', 'loans', 'debts']), // Topicos
                    'paid'         => rand(0, 1) == 1, // True o False aleatorio
                    'expiration'   => Carbon::now()->addDays(5), // El voucher expiraría en 5 dias
                    'hash'         => Str::random(35) // Hash aleatorio del voucher
                ]);

            }

        });
    }
}
