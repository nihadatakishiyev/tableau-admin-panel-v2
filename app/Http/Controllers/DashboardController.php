<?php

namespace App\Http\Controllers;

use App\Helpers\HomeContentHelper;
use App\Models\Project;
use App\Models\Tenant;
use App\Models\User;
use App\Models\View;
use App\Models\Workbook;
use App\Helpers\TrustedAuthHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\Browsershot\Browsershot;

class DashboardController extends Controller
{

    public function index(){
        $homeContentHelper = new HomeContentHelper(auth()->user()->getPermittedViews());

        return view('home')
            ->with('recents', $homeContentHelper->getRecentContent())
            ->with('recoms', $homeContentHelper->getRecommendationContent());
    }

    public function view(Project $proj, Workbook $wb, View $view){
        if ($view->pdf_url !=null){
            return view('renderPdf')->with('url', tenant_asset($view->pdf_url));
        }

        return TrustedAuthHelper::renderView($proj, $wb, $view);
    }

    public function test(){
        return auth()->user()->getPermittedHierarchy();
    }
}

