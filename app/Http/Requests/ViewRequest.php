<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;
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
        return [
            'name' => 'required|min:3|max:255|regex:/^[a-zA-Z0-9\s]+$/|unique_custom:views,name,workbook_id,' . $this->workbook_id . ',' . $this->route('id'),
            'workbook_id' => 'required',
            'tableau_url' => 'required|unique:views,tableau_url,' . $this->route('id')
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
