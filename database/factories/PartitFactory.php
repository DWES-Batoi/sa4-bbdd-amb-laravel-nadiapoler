<?php

namespace Database\Factories;

use App\Models\Partit;
use App\Models\Equip;
use App\Models\Estadi;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends Factory<\App\Models\Partit>
 */
class PartitFactory extends Factory
{
    protected $model = Partit::class;

    public function definition(): array
    {
        $data = $this->faker->dateTimeBetween('-1 year', '+1 year');

        return [
            'local_id'     => Equip::inRandomOrder()->first()->id,
            'visitant_id'  => Equip::inRandomOrder()->where('id', '!=', fn ($q) => $q)->first()->id,
            'estadi_id'    => Estadi::inRandomOrder()->first()->id,
            'data'         => $data,
            'jornada'      => $this->faker->numberBetween(1, 34),

            // Si el partido ya ha pasado → goles aleatorios
            'gols' => Carbon::instance($data)->isPast()
                ? $this->faker->numberBetween(0, 5)
                : 0,
        ];
    }
}
