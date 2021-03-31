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
              'tableau_id' => 49,
          ],
            [
                'name' => 'MyGov',
                'tableau_id' => 25,
            ]
        ];

        foreach ($projects as $project){
            Project::create($project);
        }
    }
}
