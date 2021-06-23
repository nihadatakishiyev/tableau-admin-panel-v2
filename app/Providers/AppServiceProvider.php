<?php

namespace App\Providers;

use App\Models\Project;
use http\Client\Curl\User;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use App\Helpers\MenuGenerationHelper;
use Illuminate\Support\Facades\Schema;

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
 	    Schema::defaultStringLength(191);

 	    $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            MenuGenerationHelper::generateSidebar($event);
        });

        Validator::extend('unique_custom', function ($attribute, $value, $parameters)
        {
            list($table, $field, $field2, $field2Value, $id) = $parameters;

            Log::info('field: ' . $field . ',  value: ' . $value );
            return DB::table($table)->where($field, $value)->where($field2, $field2Value)->where('id', '!=', $id)->count() == 0;
        });
    }
}
