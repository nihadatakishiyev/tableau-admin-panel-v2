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
    Route::prefix('dashboard')->group(function (){
        Route::get('', [DashboardController::class, 'index']);
        Route::get('/{proj}/{wb}/{view}', [DashboardController::class, 'renderView']);
    });

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});




