<?php

namespace Database\Seeders;

use App\Models\Equip;
use App\Models\Jugadora;
use Illuminate\Database\Seeder;

class JugadoresSeeder extends Seeder
{
    public function run(): void
    {
        // Por cada equipo, creamos 18 jugadoras
        Equip::all()->each(function ($equip) {
            Jugadora::factory()
                ->count(18)
                ->create([
                    'equip_id' => $equip->id,
                ]);
        });

        dump('JugadoresSeeder OK', Jugadora::count());
    }
}
