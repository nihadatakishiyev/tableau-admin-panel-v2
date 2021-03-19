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
        return view('pnf');
    }

    public function view(Project $proj, Workbook $wb, View $view){
        return TrustedAuthHelper::renderView($proj, $wb, $view);
    }

    public function test(){

        $pathToImage = public_path('\screenshot.png');

        Browsershot::url('http://google.com')
            ->setNodeBinary('/usr/bin/node')
//            ->setNpmBinary('C:\Users\n.atakishiyev\AppData\Roamingg\npm')
            ->save($pathToImage);
    }
}

