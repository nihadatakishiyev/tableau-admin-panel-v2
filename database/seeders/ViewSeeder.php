<?php

namespace Database\Seeders;

use App\Models\View;
use Illuminate\Database\Seeder;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $views = [
           [
               'name' => 'Əsas səhifə',
               'workbook_id' => 1,
               'tableau_url' => 'AppliesReportsver2/sasshif'
           ],
            [
                'name' => 'Ümumi',
                'workbook_id' => 2,
               'tableau_url' => 'AsanFinanceNewModel/mumi'
           ],
            [
                'name' => 'İstehlakçılar',
                'workbook_id' => 2,
               'tableau_url' => 'AsanFinanceNewModel/stehlaklar'
           ],
            [
                'name' => 'Xidmətlər',
                'workbook_id' => 2,
               'tableau_url' => 'AsanFinanceNewModel/Xidmtlr'
           ],
            [
                'name' => 'MyGov',
                'workbook_id' => 6,
               'tableau_url' => 'MyGovPortalzrHesabatlqSistemi/MyGov'
           ],
        ];

        foreach ($views as $view){
            View::create($view);
        }
    }
}
