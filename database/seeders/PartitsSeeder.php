<?php

namespace Database\Seeders;

use App\Models\Partit;
use App\Models\Equip;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PartitsSeeder extends Seeder
{
    public function run(): void
    {
        $equips = Equip::all();
        $jornada = 1;
        $data = Carbon::now()->subWeeks(10);

        foreach ($equips as $local) {
            foreach ($equips as $visitant) {

                if ($local->id === $visitant->id) {
                    continue;
                }

                Partit::create([
                    'local_id'    => $local->id,
                    'visitant_id' => $visitant->id,
                    'estadi_id'   => $local->estadi_id,
                    'data'        => $data,
                    'jornada'     => $jornada,
                    'gols'        => $data->isPast() ? rand(0, 5) : 0,
                ]);

                $jornada++;
                $data = $data->addDays(7);
            }
        }

        dump('PartitsSeeder OK', Partit::count());
    }
}
