<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngredientRequest extends FormRequest
{
    /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */
    public function authorize()
    {
        //TODO Authorice Request (without Controller)
        return auth()->user()->role_id === 1;
    }

    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
    public function rules()
    {
        //TODO Rules for Validate params depending of method doing request
        switch ($this->method()) {
            case 'GET':
                # code...
                break;
            case 'DELETE':
                break;
            case 'POST':
                return [
                    'name' => 'required|unique:ingredients|max:255',
                    'price' => 'required|regex:/^\d*(\.\d{1,2})?$/'
                ];
            case 'PUT':
                return [
                    'name' => 'required|unique:ingredients|max:255',
                    'price' => 'required|regex:/^\d*(\.\d{1,2})?$/'
                ];
            case 'PATCH':
                return [
                    'name' => 'required|max:255|unique:ingredients,name,' . $this->segment(3), //TODO segment(3) is 3 params of url
                    'price' => 'required|regex:/^\d*(\.\d{1,2})?$/'
                ];
        }
    }

    public function messages(){
        return [
            'name.required' => 'Name is required',
            'name.unique' => 'Name already exists',
            'name.max' => 'Name can\'t contain more than 255 characters',
            'price.required' => 'Price is required',
            'price.regex' => 'Price is incorrect'
        ];
    }

    //TODO method for API can access for this Request
    public function wantsJson(){
        return true;
    }
}
