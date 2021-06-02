<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ActivityLogRequest;
use App\Models\ActivityLog;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ActivityLogCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ActivityLogCrudController extends CrudController
{
    use ListOperation;
//    use CreateOperation;
//    use UpdateOperation;
//    use DeleteOperation;
    use ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(ActivityLog::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/activitylog');
        CRUD::setEntityNameStrings('activitylog', 'activity logs');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
       CRUD::column('log_name');
        CRUD::column('description');
        CRUD::column('subject_type');
        CRUD::column('subject_id');
        CRUD::column('causer_id');
        $this->crud->addColumn([
            'name' => 'properties',
            'label' => 'properties',
            'limit' => 150
        ]);
//        CRUD::column('properties');
        CRUD::column('created_at');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {

        CRUD::setValidation(ActivityLogRequest::class);

        CRUD::field('log_name');
        CRUD::field('description');
        CRUD::field('subject_type');
        CRUD::field('subject_id');
        CRUD::field('causer_id');
        CRUD::field('properties');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        CRUD::column('log_name');
        CRUD::column('description');
        CRUD::column('subject_type');
        CRUD::column('subject_id');
        CRUD::column('causer_id');
        $this->crud->addColumn([
            'name' => 'properties',
            'label' => 'properties',
            'limit' => 150
        ]);
        CRUD::column('created_at');
    }
}
