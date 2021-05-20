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
               'project_id' => 1,
           ],
            [
                'name' => 'Ümumi Analiz',
                'project_id' => 1,
            ],
            [
                'name' => 'EGov və Asan Login Analiz',
                'project_id' => 1,
            ],
            [
                'name' => 'EGov və MyGov Analiz',
                'project_id' => 1,
            ],
            [
                'name' => 'Təhlillər',
                'project_id' => 1,
            ],
            [
                'name' => 'Təhlillər 2021 Novruz',
                'project_id' => 1,
            ],
            [
                'name' => 'Video Müraciət-Real Vaxt',
                'project_id' => 1,
            ],
            [
                'name' => 'Video Müraciət-Ümumi',
                'project_id' => 1,
            ],
            [
                'name' => 'Əks Əlaqə',
                'project_id' => 2,
            ],
            [
                'name' => 'Aylıq Detallı Statistika',
                'project_id' => 2,
            ],
            [
                'name' => 'Bildirişlər',
                'project_id' => 2,
            ],
            [
                'name' => 'General',
                'project_id' => 2,
            ],
            [
                'name' => 'Həftəlik Təhlil',
                'project_id' => 2,
            ],
            [
                'name' => 'MyGov Portalı',
                'project_id' => 2,
            ],
        ];

        foreach ($wbs as $wb){
            Workbook::create($wb);
        }
    }
}
