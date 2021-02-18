<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'department_id' => 1,
                'unit_id' => 1,
                'position_id' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('123123'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'analytic',
                'email' => 'dev@dev.com',
                'department_id' => 3,
                'unit_id' => 2,
                'position_id' => 2,
                'email_verified_at' => now(),
                'password' => Hash::make('123123'),
                'remember_token' => Str::random(10),
            ]
        ];

        foreach ($users as $user){
            User::create($user);
        }
    }
}
