<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()//change it 
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:55',
            'email' => 'required|Email|unique:suppliers,email|max:55',
            'phone'=>'required|numeric',
            'category'=>'required',
            'commercial_register_number'=>'required',
            'password'=>'required|min:8',
            'commercial_register_image'=>'required|image|max:2024',
            'company_image'=>'image',

        ];
    }
}
