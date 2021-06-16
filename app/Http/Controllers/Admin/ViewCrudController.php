<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ViewRequest;
use App\Models\View;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ViewCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ViewCrudController extends CrudController
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
        CRUD::setModel(View::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/view');
        CRUD::setEntityNameStrings('view', 'views');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name' => 'id',
                'label' => 'ID',
                'type' => 'text',
            ],
            [
                'name' => 'name',
                'label' => 'Name',
                'type' => 'text',
            ],
            [
                'name' => 'workbook_id',
                'label' => 'Workbook',
                'type' => 'relationship',
                'wrapper' => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return '/admin/workbook/' . $entry->workbook_id . '/show';
                    }
                ]
            ],
            [
                'name' => 'tableau_url',
                'label' => 'Tableau URL',
                'type' => 'text',
            ],
            [
                'name' => 'pdf_url',
                'label' => 'PDF URL',
                'type' => 'text',
                'wrapper' => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return tenant_asset($entry->pdf_url);
                    }
                ]
            ]
        ]);

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
        CRUD::setValidation(ViewRequest::class);

        $this->crud->addFields([
            [
                'name' => 'name',
                'type' => 'text',
            ],
            [
                'label' => 'Project',
                'type' => 'select',
                'name' => 'project_id', //name to be referred by dependant
                'entity' => 'project', //method name in the model
                'attribute' => 'name', //attribute to be displayed, ex name, id
                'allows_null' => false,
                'default' => $this->getProjectDefault(),
                'fake' => true,
                'wrapper' => ['class' => 'form-group col-md-6']
            ],
            [
                'label' => 'Workbook', // Table column heading
                'type' => 'select2_from_ajax',
                'name' => 'workbook_id', // the column that contains the ID of that connected entity;
                'entity' => 'workbook', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'data_source' => url('api/workbook'), // url to controller search function (with /{id} should return model)
                'placeholder' => 'Select a workbook', // placeholder for the select
                'include_all_form_fields' => true, //sends the other form fields along with the request so it can be filtered.
                'minimum_input_length' => 0, // minimum characters to type before querying results
                'dependencies' => ['project_id'], // when a dependency changes, this select2 is reset to null
                'wrapper' => ['class' => 'form-group col-md-6']
            ],
            [
                'name' => 'is_pdf',
                'label' => "Is PDF",
                'type' => 'select_from_array',
                'options' => ['no' => 'No', 'yes' => 'Yes'],
                'default' => $this->isPdf() ? 'yes' : 'no',
                'fake' => 'true',
                'allows_null' => false,
                'wrapper' => ['class' => 'form-group col-md-6']
            ],
            [
                'name' => 'tableau_url',
                'type' => 'text',
                "visibility" => [
                    'field_name' => 'is_pdf',
                    'value' => 'no',
                    'add_disabled' => true,
                ],
                'wrapper' => ['class' => 'form-group col-md-6']
            ],
            [
                'name' => 'pdf_url',
                'label' => 'PDF',
                'type' => 'upload',
                'upload' => true,
                'disk' => 'uploads',
                'wrapper' => ['class' => 'form-group col-md-6'],
                "visibility" => [
                    'field_name' => 'is_pdf',
                    'value' => 'yes',
                    'add_disabled' => true,
                ]
            ],
        ]);
    }


    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function isPdf(): bool
    {
        $url = explode('/', request()->url());
        if (count($url) > 2){
            $id = $url[count($url) - 2];
            return View::find($id)?->pdf_url != null;
        }
        return false;
    }

    protected function getProjectDefault()
    {
        $url = explode('/', request()->url());
        if (count($url) > 2){
            $id = $url[count($url) - 2];
        }
        return View::find($id)?->workbook?->project?->id;
    }
}
