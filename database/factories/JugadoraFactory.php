<?php

namespace Database\Factories;

use App\Models\Jugadora;
use App\Models\Equip;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class JugadoraFactory extends Factory
{
    protected $model = Jugadora::class;

    public function definition(): array
    {
        return [
            'equip_id' => Equip::factory(),
            'data_naixement' => Carbon::now()
                ->subYears($this->faker->numberBetween(16, 35))
                ->subDays($this->faker->numberBetween(0, 365)),
            'dorsal' => $this->faker->numberBetween(1, 30),
            'foto' => 'jugadores/default.png',
        ];
    }
}
