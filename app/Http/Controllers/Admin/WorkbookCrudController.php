<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\WorkbookRequest;
use App\Models\Workbook;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class WorkbookCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class WorkbookCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Workbook::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/workbook');
        CRUD::setEntityNameStrings('workbook', 'workbooks');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('id');
        CRUD::column('name');
        CRUD::column('project_id');
        CRUD::column('order_number');


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
        CRUD::setValidation(WorkbookRequest::class);

        CRUD::field('name');
        CRUD::field('project_id')->size(6);
//        $this->crud->addField([
//           'name' => 'order_number',
//           'label' => 'Order number',
//           'type' =>  'select_from_array',
//            'options' => [1,2,3],
//            'wrapper' => ['class' => 'form-group col-md-6']
//        ]);

//        $this->crud->addField([
//            'label' => 'Order number', // Table column heading
//            'type' => 'select2_from_ajax',
//            'name' => 'order_number', // the column that contains the ID of that connected entity;
//            'entity' => 'project', // the method that defines the relationship in your Model
//            'attribute' => 'order_number', // foreign key attribute that is shown to user
//            'data_source' => url('api/workbook'),
//            'placeholder' => 'Select an order number', // placeholder for the select
//            'include_all_form_fields' => true, //sends the other form fields along with the request so it can be filtered.
//            'minimum_input_length' => 0, // minimum characters to type before querying results
//            'dependencies' => ['project_id'], // when a dependency changes, this select2 is reset to null
//            'wrapper' => ['class' => 'form-group col-md-6']
//        ]);

        $this->crud->addField([   // Number
            'name' => 'order_number',
            'label' => 'Order number',
            'type' => 'number',
            'wrapper' => ['class' => 'form-group col-md-6']
        ]);

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
        CRUD::column('id');
        CRUD::column('name');
        CRUD::column('project_id');
    }

    protected function getOrderArray(){
    }
}
