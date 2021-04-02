<?php

namespace App\Http\Controllers;

use App\Helpers\HomeContentHelper;
use App\Models\Project;
use App\Models\View;
use App\Models\Workbook;
use App\Helpers\TrustedAuthHelper;
use Illuminate\Support\Facades\DB;
use Spatie\Browsershot\Browsershot;

class DashboardController extends Controller
{

    public function index(){

        $homeContentHelper = new HomeContentHelper(auth()->user()->getPermittedViews());

        return view('home')
            ->with('dashboards', $homeContentHelper->getRecommendationContent())
            ->with('recents', $homeContentHelper->getRecentContent());

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

