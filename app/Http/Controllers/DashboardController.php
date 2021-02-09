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

//        return view('pnf');
          $projs = Project::with('workbooks', 'workbooks.views')->get();
          $perms = auth()->user()->getPermissionsViaRoles();
          $arr = [];

          foreach ($projs as $i => $proj){
              if(auth()->user()->can($proj->name) || $this->projChecker($perms, $proj->name)){
                  array_push($arr, $proj);
                  foreach ($proj->workbooks as $j=> $workbook){
                      if (!auth()->user()->can($proj->name . '.' . $workbook->name) && !$this->wbChecker($perms, $workbook->name)){
                          unset($arr[$i]->workbooks[$j]);
                      }
                      else {
                          foreach ($workbook->views as $k => $view){
                              if (!auth()->user()->can($proj->name . '.' . $workbook->name . '.' . $view->name) && !$this->viewChecker($perms, $view->name)){
                                  unset($arr[$i]->workbooks[$j]->views[$k]);
                              }
                          }
                      }
                  }
              }
          }
          return $arr;
    }

    public function projChecker($perms, $name): bool
    {
        foreach ($perms as $i => $perm) {
            $temp = explode( '.', $perm->name);
            if (!strcmp($temp[0], $name)){
                return true;
            }
        }
        return false;
    }

    public function wbChecker($perms, $name): bool
    {
        foreach ($perms as $perm) {
            $temp = explode( '.', $perm->name);
            if (count($temp) > 1 && !strcmp($temp[1], $name)){
                return true;
            }
        }
        return false;
    }

    public function viewChecker($perms, $name): bool
    {
        foreach ($perms as $perm) {
            $temp = explode( '.', $perm->name);
            if (count($temp) > 2 && !strcmp($temp[2], $name)){
                return true;
            }
        }
        return false;
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
