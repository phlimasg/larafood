<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:App\Models\Plan,name|max:250',
            'description' => 'required|max:240',
            //'url' => 'required|unique:App\Models\Plan,url|max:250',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            
        ];
    }
}
