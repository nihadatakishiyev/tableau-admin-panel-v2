<?php

namespace App\Http\Controllers;

use App\Helpers\ApiAuthHelper;
use App\Models\Project;
use App\Models\View;
use App\Models\Workbook;
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
    }

    public function renderView(Project $proj, Workbook $wb, View $view){

        if ($view->workbook_id == $wb->id && $wb->project_id == $proj->id && auth()->user()->can($proj->name . '.' . $wb->name . '.' . $view->name)){
            $url = TrustedAuthHelper::get_trusted_url($this->user, $this->remote_addr, 'views/' . $view->tableau_url, '');

            return view('renderView')->with('url', $url);
        }
        abort(403);
    }

    public function test(){
        $url = TrustedAuthHelper::get_trusted_url($this->user, $this->remote_addr, 'views/E-GovGeneral/Finaldashboard', '');

        return view('test')->with('url', $url);
    }





}
