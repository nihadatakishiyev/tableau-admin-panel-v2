<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\View;
use App\Models\Workbook;
use App\Helpers\TrustedAuthHelper;

class DashboardController extends Controller
{
//    private $user = 'ehim.analytics';
    private $user = 'ehim.analytics';
    private $remote_addr = '192.168.20.213';

    public function index(){
        return view('pnf');
    }

    public function renderView(Project $proj, Workbook $wb, View $view){
        try {
            if ($view->workbook_id == $wb->id && $wb->project_id == $proj->id && auth()->user()->can($proj->name . '.' . $wb->name . '.' . $view->name)){
                if (auth()->user()->existsValidTicket()){
                     $url = TrustedAuthHelper::get_trusted_url($this->user, $this->remote_addr, 'views/' . $view->tableau_url, 1);
                }
                else {
                    $url = TrustedAuthHelper::get_trusted_url($this->user, $this->remote_addr, 'views/' . $view->tableau_url, 0);
                }

                return view('renderView')->with('url', $url);
            }
            return view('errors.403');
        } catch (\Exception $e){
            return $e->getMessage();
        }
    }
}
