<?php

namespace App\Http\Controllers;

use App\Helpers\HomeContentHelper;
use App\Helpers\RestApiAuthHelper;
use App\Models\Project;
use App\Models\View;
use App\Models\Workbook;
use App\Helpers\TrustedAuthHelper;

class DashboardController extends Controller
{

    public function index(){
        $homeContentHelper = new HomeContentHelper(auth()->user()->getPermittedViews());

        return view('home')
            ->with('recents', $homeContentHelper->getRecentContent())
            ->with('recoms', $homeContentHelper->getRecommendationContent());
    }

    public function show(Project $proj, Workbook $wb, View $view){
        if ($view->pdf_url !=null){
            return view('renderPdf')->with('url', tenant_asset($view->pdf_url));
        }

        return TrustedAuthHelper::renderView($proj, $wb, $view);
    }

    public function test()
    {
        return RestApiAuthHelper::getAuthToken();
//        return auth()->user()->can('Asan Finans.Ümumi.Qurum və xidmət siyahısı');
    }



}

