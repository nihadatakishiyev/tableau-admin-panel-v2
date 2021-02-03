<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'department_id' => $this->faker->numberBetween(1, Department::count()),
            'unit_id' => $this->faker->numberBetween(1, Unit::count()),
            'position_id' => 0,
            'email_verified_at' => now(),
            'password' => Hash::make('123123'),
            'remember_token' => Str::random(10),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user){
            $user->position_id = $this->faker->randomElement(DB::table('unit_positions')->where('unit_id', $user->unit_id)->get()->toArray());
        });
    }
}
