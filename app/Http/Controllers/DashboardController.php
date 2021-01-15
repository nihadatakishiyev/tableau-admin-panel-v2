<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function asanLoginRealTime(){
        if (1)
        {
           return view('dashboards.AsanLogin.AsanLoginRealTime');
        }
    }

    public function asanLoginMainPage(){
        if (1)
        {
            return view('dashboards.AsanLogin.AsanLoginMainPage');
        }
    }

    public function asanFinanceGeneral(){
        if (1)
        {
            return view('dashboards.AsanLogin.AsanFinanceGeneral');
        }
    }
}
