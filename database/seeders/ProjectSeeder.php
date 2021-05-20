<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = [
          [
              'name' => 'ASAN Login',
          ],
            [
                'name' => 'MyGov',
            ]
        ];

        foreach ($projects as $project){
            Project::create($project);
        }
    }
}
