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
               'name' => 'Real Vaxt Analizi',
               'workbook_id' => 1,
               'tableau_url' => 'AsanLoginRealTime/RealVaxtstatistikas'
           ],
            [
                'name' => 'Asan Login',
                'workbook_id' => 2,
               'tableau_url' => 'AsanLoginver03/AsanLogin'
           ],
            [
                'name' => 'Tətbiqlər Unikal Istifadəçi',
                'workbook_id' => 2,
               'tableau_url' => 'AsanLoginver03/Ttbiqlrzrunikalistifadistatistikas'
           ],
            [
                'name' => 'İstifadəçi məlumatları',
                'workbook_id' => 2,
               'tableau_url' => 'AsanLoginver03/stifadimlumatlar'
           ],
            [
                'name' => '1 gün ərzində proseslər',
                'workbook_id' => 2,
               'tableau_url' => 'AsanLoginver03/1gnrzindsistemdgednproseslr'
           ],
            [
                'name' => 'General',
                'workbook_id' => 3,
               'tableau_url' => 'EGovvsAsanLogin/General'
           ],
            [
                'name' => 'General',
                'workbook_id' => 4,
               'tableau_url' => 'EGovvsMyGov/General'
           ],
            [
                'name' => 'Həftəlik Hesabat-Ver01',
                'workbook_id' => 5,
               'tableau_url' => 'Thlillr/Hftlikhesabat-Ver01'
           ],
            [
                'name' => 'Həftəlik Hesabat-Ver02',
                'workbook_id' => 5,
               'tableau_url' => 'Thlillr/Hftlikhesabat-Ver02'
           ],
            [
                'name' => 'Həftəlik Hesabat-Ver01',
                'workbook_id' => 6,
               'tableau_url' => 'Thlillr2021Novruz/Hftlikhesabat-Ver01'
           ],
            [
                'name' => 'Video Müraciət-Real Vaxt',
                'workbook_id' => 7,
               'tableau_url' => 'AsanLoginvideomracitlr-Realvaxt/VideomracitlrRealvaxt'
           ],
            [
                'name' => 'AI Nəzarət-Real Vaxt',
                'workbook_id' => 7,
               'tableau_url' => 'AsanLoginvideomracitlr-Realvaxt/AInnzart-Realvaxt'
           ],
            [
                'name' => 'Video Müraciətlər-DWH',
                'workbook_id' => 8,
               'tableau_url' => 'AsanLoginvideomracitlr/Videomracitlr-DWH'
           ],
            [
                'name' => 'AI Nəzarət-DWH',
                'workbook_id' => 8,
               'tableau_url' => 'AsanLoginvideomracitlr/AInnzart-DWH'
           ],
            [
                'name' => 'General',
                'workbook_id' => 9,
               'tableau_url' => 'kslaq/General'
           ],
            [
                'name' => 'Qurum/Xidmət',
                'workbook_id' => 9,
               'tableau_url' => 'kslaq/QurumXidmt'
           ],
            [
                'name' => 'Son Ay',
                'workbook_id' => 10,
               'tableau_url' => 'Aylqdetallstatistika/Sonay'
           ],
            [
                'name' => 'General',
                'workbook_id' => 11,
               'tableau_url' => 'Bildirilr/General'
           ],
            [
                'name' => 'General',
                'workbook_id' => 12,
               'tableau_url' => 'General_16099131686900/General'
           ],
            [
                'name' => 'Siyahı',
                'workbook_id' => 12,
               'tableau_url' => 'General_16099131686900/Siyah'
           ],
            [
                'name' => '1-ci Versiya',
                'workbook_id' => 13,
               'tableau_url' => 'Hftlikthlil_16158936075370/1-civersiya'
           ],
            [
                'name' => '2-ci Versiya',
                'workbook_id' => 13,
               'tableau_url' => 'Hftlikthlil_16158936075370/2-civersiya'
           ],
            [
                'name' => 'MyGov',
                'workbook_id' => 14,
               'tableau_url' => 'MyGovPortalzrHesabatlqSistemi/MyGov'
           ],
        ];

        foreach ($views as $view){
            View::create($view);
        }
    }
}
