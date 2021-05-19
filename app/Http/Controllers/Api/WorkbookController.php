<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Workbook;
use Illuminate\Http\Request;

class WorkbookController extends Controller
{
    public function index(Request $request)
    {
        $search_term = $request->input('q');

        // NOTE: this is a Backpack helper that parses your form input into an usable array.
        // you still have the original request as `request('form')`
        $form = backpack_form_input();

        $options = Workbook::query();

        // if no category has been selected, show no options
        if (! $form['project_id']) {
            return [];
        }

        // if a category has been selected, only show articles in that category
        if ($form['project_id']) {
            $options = $options->where('project_id', $form['project_id']);
        }

        if ($search_term) {
            $results = $options->where('name', 'LIKE', '%'.$search_term.'%')->paginate(10);
        } else {
            $results = $options->paginate(10);
        }

        return $results;
    }

    public function show($id)
    {
        return Workbook::find($id);
    }
}
