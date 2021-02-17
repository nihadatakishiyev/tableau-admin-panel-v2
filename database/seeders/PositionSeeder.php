<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            ['name' => 'default'],
            ['name' => 'Junior Specialist'],
            ['name' => 'Specialist'],
            ['name' => 'Senior Specialist'],
        ];

        foreach ($positions as $position){
            Position::create($position);
        }
    }
}
