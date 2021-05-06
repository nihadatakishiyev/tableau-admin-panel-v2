<?php

namespace App\Http\Controllers;

use App\Helpers\HomeContentHelper;
use App\Models\Project;
use App\Models\Tenant;
use App\Models\View;
use App\Models\Workbook;
use App\Helpers\TrustedAuthHelper;
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
        return TrustedAuthHelper::renderView($proj, $wb, $view);
    }

    public function test(){
        $tenant1 = Tenant::create(['id' => 'egov']);
        $tenant1->domains()->create(['domain' => 'egov.ltab']);

        $tenant2 = Tenant::create(['id' => 'asan']);
        $tenant2->domains()->create(['domain' => 'asan.ltab']);
    }
}

