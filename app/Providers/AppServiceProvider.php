<?php

namespace App\Providers;

use http\Client\Curl\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        $user = request()->user();
//        $user = Auth::user();

        view()->composer('*', function($view)
        {
//            dd(Auth::user());
            if (Auth::check()) {
                $user = Auth::user();
                $data = $user->getPermissionsViaRoles();
                $permissions = array();

                foreach ($data as $i=>$dt){
                    $perm_id = $dt['pivot']['permission_id'] ;
                    $perm_name = DB::table('permissions')->where('id', $perm_id)->value('name');
                    array_push($permissions, $perm_name);
                }

                // Sharing is caring
                view()->share('permissions', $permissions);
            }
//            else {
//                $view->with('currentUser', null);
//            }
        });

//        dd($user);

    }
}
