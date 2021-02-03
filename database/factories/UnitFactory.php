<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Unit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Data Analytics', 'Machine Learning', 'Mobile Dev', 'ESD']),
            'department_id' => $this->faker->numberBetween(1, Department::count())
        ];
    }
}
