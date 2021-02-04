<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Throwable;

class DashboardController extends Controller
{
    private $user = 'ehim.analytics';
    private $remote_addr = '192.168.20.213';


    public function index(){
        try {
            $user = Auth::user();
            $datas = $user->getPermissionsViaRoles();
            $permissions = array();

            foreach ($datas as $i=>$data){
                $perm_id = $data['pivot']['permission_id'] ;
                $perm_name = DB::table('permissions')->where('id', $perm_id)->value('name');
                array_push($permissions, $perm_name);
            }


            if(sizeof($permissions)>0){
                return redirect(route(''.$permissions[0]));
            }
            else{
                return view('errors.401');
            }
        }catch (Throwable $e){
            return view('pnf')->with('error', $e->getMessage());
        }
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

    public function get_trusted_ticket($wgserver, $user) {

        $ticket = Http::asForm()->post("http://$wgserver/trusted", [
            'username' => $user,
        ])->body();

        return $ticket;
    }

    public function get_trusted_url($user, $server, $view_url, $site) {
        $params = ':embed=yes&:toolbar=no:tabs=no';
        $ticket = $this->get_trusted_ticket($server, $user);

        return "http://$server/trusted/$ticket/$view_url?$params";
    }

    public function test(){
        $url = $this->get_trusted_url($this->user, $this->remote_addr, 'views/E-GovGeneral/Finaldashboard', '');

        return view('test')->with('url', $url);
    }

}
