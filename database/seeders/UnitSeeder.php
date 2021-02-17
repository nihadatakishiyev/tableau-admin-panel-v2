<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = [
            [
                'name' => 'default',
                'department_id' => 1,
            ],
            [
                'name' => 'Machine Learning',
                'department_id' => 3,
            ],
            [
                'name' => 'Assessment',
                'department_id' => 2,
            ]
        ];

        foreach ($units as $unit){
            Unit::create($unit);
        }
    }
}
