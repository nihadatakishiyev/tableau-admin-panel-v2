<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('user', 'UserCrudController');
    Route::crud('department', 'DepartmentCrudController');
    Route::crud('unit', 'UnitCrudController');
    Route::crud('position', 'PositionCrudController');
    Route::crud('project', 'ProjectCrudController');
    Route::crud('workbook', 'WorkbookCrudController');
    Route::crud('view', 'ViewCrudController');
    Route::crud('activitylog', 'ActivityLogCrudController');
    Route::crud('authlog', 'AuthLogCrudController');
    Route::crud('pagevisitlog', 'PageVisitLogCrudController');
}); // this should be the absolute last line of this file