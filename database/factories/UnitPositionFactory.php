<?php

namespace Database\Factories;

use App\Models\Position;
use App\Models\Unit;
use App\Models\UnitPosition;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnitPositionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UnitPosition::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unit_id' => $this->faker->numberBetween(1, Unit::count()),
            'position_id' => $this->faker->numberBetween(1, Position::count())
        ];
    }
}
