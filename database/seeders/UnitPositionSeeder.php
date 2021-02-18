<?php

namespace Database\Seeders;

use App\Models\UnitPosition;
use Illuminate\Database\Seeder;

class UnitPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unit_positions = [
            [
                'unit_id' => 1,
                'position_id' => 1,
            ],
            [
                'unit_id' => 2,
                'position_id' => 2,
            ],
            [
                'unit_id' => 2,
                'position_id' => 3,
            ],            [
                'unit_id' => 2,
                'position_id' => 4,
            ],
            [
                'unit_id' => 3,
                'position_id' => 2,
            ],
            [
                'unit_id' => 3,
                'position_id' => 3,
            ],            [
                'unit_id' => 3,
                'position_id' => 4,
            ],
        ];

        foreach ($unit_positions as $unit_position){
            UnitPosition::create($unit_position);
        }
    }
}
