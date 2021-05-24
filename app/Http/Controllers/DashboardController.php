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


        $res = User::select('id')->where('name', 'like', '%admin%')->pluck('id')->toArray();

        return implode(',', $res);

    }
}

