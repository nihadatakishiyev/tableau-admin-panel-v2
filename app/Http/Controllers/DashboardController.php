<?php

namespace App\Http\Controllers;

use App\Helpers\ApiAuthHelper;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Throwable;
use App\Helpers\TrustedAuthHelper;
use App\Helpers\MenuGenerationHelper;

class DashboardController extends Controller
{
    private $user = 'ehim.analytics';
    private $remote_addr = '192.168.20.213';

    public function index(){
        return view('pnf');

        return $arr = [
            [
                'text' => 'level_three',
                'url'  => '#',
            ],
            [
                'text' => 'level_three',
                'url'  => '#',
            ],
        ];
    }



    public function asanLoginRealTime(){
        $user = Auth::user();

        if ($user->can('AsanLoginRealTime'))
        {
           return view('dashboards.AsanLogin.AsanLoginRealTime');
        }
        return response()->view('errors.401', [], 401);
    }

    public function asanLoginMainPage(){
        $user = Auth::user();

        if ($user->can('AsanLoginMainPage'))
        {
            return view('dashboards.AsanLogin.AsanLoginMainPage');
        }
        return response()->view('errors.401', [], 401);
    }

    public function asanFinanceGeneral(){
        $user = Auth::user();

        if ($user->can('AsanFinanceGeneral'))
        {
            return view('dashboards.AsanFinance.AsanFinanceGeneral');
        }
        return response()->view('errors.401', [], 401);
    }

    public function test(){
        $url = TrustedAuthHelper::get_trusted_url($this->user, $this->remote_addr, 'views/E-GovGeneral/Finaldashboard', '');

        return view('test')->with('url', $url);
    }

    public function authTest(){
//        ApiAuthHelper::getAuthToken();
//        $proj = Project::all();
//        return Project::with('workbooks', 'workbooks.views')->get();
        return view('pnf');
    }





}
