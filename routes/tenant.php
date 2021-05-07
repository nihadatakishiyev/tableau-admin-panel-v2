<?php

declare(strict_types=1);

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TrackPageVisits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Auth::routes([
        'register' => false,
        'reset' => false
    ]);

    Route::middleware(['auth', TrackPageVisits::class])->group(function (){
        Route::redirect('/', '/dashboard')->name('home');
        Route::resource('users', UserController::class)->only([
            'update', 'edit'
        ]);


        Route::prefix('dashboard')->group(function (){
            Route::get('', [DashboardController::class, 'index']);
            Route::get('/{proj}/{wb}/{view}', [DashboardController::class, 'view']);
        });

        Route::get('/logout', function(){
            return redirect('login')->with(Auth::logout());
        })->name('logout_bck');
    });

    Route::get('/test', [DashboardController::class, 'test']);

    Route::middleware('auth')->group(function (){
        Route::get('/api/unit', 'App\Http\Controllers\Api\UnitController@index');
        Route::get('/api/unit/{id}', 'App\Http\Controllers\Api\UnitController@show');

        Route::get('/api/position', 'App\Http\Controllers\Api\PositionController@index');
        Route::get('/api/position/{id}', 'App\Http\Controllers\Api\PositionController@show');
    });
});
