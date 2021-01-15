<?php

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
    'register' => false
]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/dashboard/asanLoginRealTime', [DashboardController::class, 'asanLoginRealTime']);

Route::prefix('dashboard')->middleware('auth')->group(function (){
    Route::get('/asanLoginRealTime', [DashboardController::class, 'asanLoginRealTime']);
    Route::get('/asanLoginMainPage', [DashboardController::class, 'asanLoginMainPage']);
    Route::get('/asanFinanceGeneral', [DashboardController::class, 'asanFinanceGeneral']);
});