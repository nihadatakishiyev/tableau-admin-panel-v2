<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\View;
use App\Models\Workbook;
use App\Helpers\TrustedAuthHelper;
use Spatie\Browsershot\Browsershot;

class DashboardController extends Controller
{

    public function index(){
        $dashboards = [
           'dashboard1' => [
               'name' => 'MyGov',
               'hour' => '4 hours ago'
           ],
            'dashboard2' => [
               'name' => 'Asan Finance',
               'hour' => '2 hours ago'
           ],
            'dashboard3' => [
               'name' => 'EGov',
               'hour' => '3 hours ago'
           ],
            'dashboard4' => [
               'name' => 'AsanPay',
               'hour' => '1 hour ago'
           ],
        ];
        return view('home')->with('dashboards', $dashboards);
    }

    public function view(Project $proj, Workbook $wb, View $view){
        return TrustedAuthHelper::renderView($proj, $wb, $view);
    }

    public function test(){

        $pathToImage = public_path('\screenshot.png');

        Browsershot::url('http://google.com')
            ->setNodeBinary('C:\Programs\nodejs\node.exe')
//            ->setNpmBinary('C:\Users\n.atakishiyev\AppData\Roamingg\npm')
            ->save($pathToImage);
    }
}

