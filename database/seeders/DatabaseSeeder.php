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
        $this->call(DepartmentSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(UnitPositionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(WorkbookSeeder::class);
        $this->call(ViewSeeder::class);
        $this->call(RoleSeeder::class);

        $user = User::findOrFail(1);
        $user->assignRole('admin');
        $user->save();
    }
}
