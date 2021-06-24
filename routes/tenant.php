<?php

declare(strict_types=1);

use App\Http\Controllers\Api\PositionController;
use App\Http\Controllers\Api\UnitController;
use App\Http\Controllers\Api\WorkbookController;
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
    ]);

    Route::middleware(['auth', TrackPageVisits::class])->group(function (){
        Route::redirect('/', '/dashboard')->name('home');
        Route::resource('users', UserController::class)->only([
            'update', 'edit'
        ]);


        Route::prefix('dashboard')->group(function (){
            Route::get('', [DashboardController::class, 'index']);
            Route::get('/{proj}/{wb}/{view}', [DashboardController::class, 'show']);
        });

        Route::get('/logout', function(){
            return redirect('login')->with(Auth::logout());
        })->name('logout_bck');
    });

    Route::get('/test', [DashboardController::class, 'test']);
    Route::get('/test2', function (){
        return \auth()->user()->getPermittedHierarchy();
    });

    Route::middleware(['auth', 'admin'])->group(function (){
        Route::get('/api/unit', [UnitController::class, 'index']);
        Route::get('/api/unit/{id}', [UnitController::class, 'show']);

        Route::get('/api/position', [PositionController::class, 'index']);
        Route::get('/api/position/{id}', [PositionController::class, 'show']);

        Route::get('/api/workbook', [WorkbookController::class, 'index']);
        Route::get('/api/workbook/{id}', [WorkbookController::class, 'show']);
    });
});
