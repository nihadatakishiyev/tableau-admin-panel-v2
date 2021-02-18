<?php

namespace Database\Seeders;

use App\Models\Workbook;
use Illuminate\Database\Seeder;

class WorkbookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wbs = [
           [
               'name' => 'Applies Report ver2',
               'tableau_id' => 666,
               'project_id' => 1,
           ],
            [
                'name' => 'Asan Finance New Model',
                'tableau_id' => 641,
                'project_id' => 1,
            ],
            [
                'name' => 'Əks Əlaqə',
                'tableau_id' => 462,
                'project_id' => 2,
            ],
            [
                'name' => 'Bildirişlər',
                'tableau_id' => 656,
                'project_id' => 2,
            ],
            [
                'name' => 'General',
                'tableau_id' => 653,
                'project_id' => 2,
            ],
            [
                'name' => 'MyGov Portalı',
                'tableau_id' => 334,
                'project_id' => 2,
            ],
        ];

        foreach ($wbs as $wb){
            Workbook::create($wb);
        }
    }
}
