<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'name' => 'default',
            'created_at' => now()
        ]);

        DB::table('units')->insert([
            'name' => 'default',
            'department_id' => 1,
            'created_at' => now()
        ]);

        DB::table('positions')->insert([
            'name' => 'default',
            'created_at' => now()
        ]);

        DB::table('unit_positions')->insert([
            'unit_id' => 1,
            'position_id' => 1,
            'created_at' => now()

        ]);

        DB::table('users')->insert([
           'name' => 'admin',
            'email' => 'admin@admin.com',
            'department_id' => 1,
            'unit_id' => 1,
            'position_id' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('123123'),
            'remember_token' => Str::random(10),
            'created_at' => now()
        ]);

        Permission::create([
            'name' => 'admin'
        ]);
    }
}
