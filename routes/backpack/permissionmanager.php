<?php

/*
|--------------------------------------------------------------------------
| Backpack\PermissionManager Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are
| handled by the Backpack\PermissionManager package.
|
*/

use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::group([
    'namespace'  => 'App\Http\Controllers',
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', backpack_middleware(), InitializeTenancyByDomain::class, PreventAccessFromCentralDomains::class],
], function () {
    Route::crud('permission', 'PermissionCrudController');
    Route::crud('role', 'RoleCrudController');
    Route::crud('user', 'UserCrudController');
});
