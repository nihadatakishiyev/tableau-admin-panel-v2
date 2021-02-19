<?php

namespace Database\Seeders;

use App\Models\UnitPosition;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DepartmentSeeder::class,
            UnitSeeder::class,
            PositionSeeder::class,
            UnitPositionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            ProjectSeeder::class,
            WorkbookSeeder::class,
            ViewSeeder::class,
        ]);
    }
}
