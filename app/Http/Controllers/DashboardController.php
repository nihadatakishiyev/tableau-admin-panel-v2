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

class DashboardController extends Controller
{
    private $user = 'ehim.analytics';
    private $remote_addr = '192.168.20.213';

    public function index(){
//        try {
//            $datas = \auth()->user()->getPermissionsViaRoles();
//            $permissions = array();
//
//            foreach ($datas as $i=>$data){
//                $perm_id = $data['pivot']['permission_id'] ;
//                $perm_name = DB::table('permissions')->where('id', $perm_id)->value('name');
//                array_push($permissions, $perm_name);
//            }
//
//
//            if(sizeof($permissions)>0){
//                return redirect(route(''.$permissions[0]));
//            }
//            else{
//                abort(404);
//            }
//        }catch (Throwable $e){
////            return view('errors.404')->with('error', $e->getMessage());
//            abort(404);
//        }
//        return \auth()->user()->can('all');

        return view('pnf');
//            return \auth()->user()->can('ASAN Finans.Asan Finance New Model');
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
