<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() //do not forget to change it to false
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|Email|unique:clients,email|max:55',
            'name' => 'required|max:55',
            'phone'=>'required|numeric',
            'password'=>'required|min:8',
            'city'=>'required',
            'regien'=>'required',
        ];
    }
}
