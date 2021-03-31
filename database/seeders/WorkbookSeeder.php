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
               'name' => 'Real Vaxt Analizi',
               'tableau_id' => 644,
               'project_id' => 1,
           ],
            [
                'name' => 'Ümumi Analiz',
                'tableau_id' => 701,
                'project_id' => 1,
            ],
            [
                'name' => 'EGov və Asan Login Analiz',
                'tableau_id' => 725,
                'project_id' => 1,
            ],
            [
                'name' => 'EGov və MyGov Analiz',
                'tableau_id' => 664,
                'project_id' => 1,
            ],
            [
                'name' => 'Təhlillər',
                'tableau_id' => 726,
                'project_id' => 1,
            ],
            [
                'name' => 'Təhlillər 2021 Novruz',
                'tableau_id' => 732,
                'project_id' => 1,
            ],
            [
                'name' => 'Video Müraciətlər-Real Vaxt',
                'tableau_id' => 714,
                'project_id' => 1,
            ],
            [
                'name' => 'Video müraciətlər-Ümumi',
                'tableau_id' => 698,
                'project_id' => 1,
            ],
            [
                'name' => 'Əks Əlaqə',
                'tableau_id' => 462,
                'project_id' => 2,
            ],
            [
                'name' => 'Aylıq Detallı Statistika',
                'tableau_id' => 706,
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
                'name' => 'Həftəlik Təhlil',
                'tableau_id' => 721,
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
