<?php

namespace App\Http\Controllers;

use App\Helpers\HomeContentHelper;
use App\Helpers\RestApiAuthHelper;
use App\Models\PageVisitLog;
use App\Models\Project;
use App\Models\View;
use App\Models\Workbook;
use App\Helpers\TrustedAuthHelper;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index(){
        $homeContentHelper = new HomeContentHelper(auth()->user()->getPermittedViews());

        if (auth()->user()->isFirstLogin()){
            request()->session()->flash('reminder', 'Hesabatların görüntülənməsində hər hansı bir problem yaşandığı halda FAQ səhifəsinə nəzər yetirməniz xahiş olunur.');
        }

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
        return DB::table('page_visit_logs')->where('user_id', auth()->id())->count();
    }



}

