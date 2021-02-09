<?php

namespace App\Providers;

use App\Models\Project;
use http\Client\Curl\User;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use App\Helpers\MenuGenerationHelper;

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
    public function boot(Dispatcher $events)
    {
//
//        view()->composer('*', function($view)
//        {
//            if (Auth::check()){
//                view()->share('permissions', Project::with('workbooks', 'workbooks.views')->get());
//            }
//        });
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            MenuGenerationHelper::generateAdminLte($event);
        });

    }
}
