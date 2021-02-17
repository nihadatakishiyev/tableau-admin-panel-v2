<?php

use App\Http\Middleware\TrackPageVisits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Auth::routes([
    'register' => false,
    'reset' => false
]);

Route::middleware([TrackPageVisits::class, 'auth'])->group(function (){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('dashboard')->group(function (){
        Route::get('', [DashboardController::class, 'index']);
        Route::get('/{proj}/{wb}/{view}', [DashboardController::class, 'renderView']);
    });
});

Route::middleware('auth')->group(function (){
    Route::get('/api/unit', 'App\Http\Controllers\Api\UnitController@index');
    Route::get('/api/unit/{id}', 'App\Http\Controllers\Api\UnitController@show');

    Route::get('/api/position', 'App\Http\Controllers\Api\PositionController@index');
    Route::get('/api/position/{id}', 'App\Http\Controllers\Api\PositionController@show');
});




