<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
//        $user = Auth::user();
//        $data = $user->getPermissionsViaRoles();
//        $permissions = array();
//
//        foreach ($data as $i=>$dt){
//            $perm_id = $dt['pivot']['permission_id'] ;
//            $perm_name = DB::table('permissions')->where('id', $perm_id)->value('name');
//             array_push($permissions, $perm_name);
//        }

        return view('layouts.dashboard');
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
}
