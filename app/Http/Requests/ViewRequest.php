<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Workbook;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request as Request2;
use Illuminate\Validation\Rule;

/**
 * @property mixed workbook_id
 */
class ViewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */


    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $is_pdf = in_array(request('workbook_id'), Workbook::select('id')->where('name', 'Təhlil arayışları')->pluck('id')->toArray());

        if ($is_pdf){
            return [
                'name' => 'required|min:3|max:255|regex:/^[\pL\s\-0-9]+$/u|unique_custom:views,name,workbook_id,' . $this->workbook_id . ',' . $this->route('id'),
                'workbook_id' => 'required',
                'pdf_url' => 'required'
            ];
        }

        return [
            'name' => 'required|min:3|max:255|regex:/^[\pL\s\-0-9]+$/u|unique_custom:views,name,workbook_id,' . $this->workbook_id . ',' . $this->route('id'),
            'workbook_id' => 'required',
            'tableau_url' => 'required|unique:views,tableau_url,' . $this->route('id'),
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.unique_custom' => 'Name already exists for the specified workbook',
            'name.regex' => 'The name my only contain letters, numbers, and space'
        ];
    }
}
