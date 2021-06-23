<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property mixed project_id
 */
class WorkbookRequest extends FormRequest
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
        return [
            'name' => 'required|min:3|max:255|regex:/^[\pL\s\-0-9]+$/u|unique_custom:workbooks,name,project_id,' . $this->project_id . ',' . $this->route('id'),
            'project_id' => 'required',
//            'order_number' => 'unique_custom:workbooks,order_number,project_id,' . $this->project_id . ',' . $this->route('id')
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
            'name.unique_custom' => 'The name already exists for the specified project',
            'name.regex' => 'The name my only contain letters, numbers, and space',
//            'order_number.unique_custom' => 'A workbook with the specified order number already exists for the project'
        ];
    }
}
