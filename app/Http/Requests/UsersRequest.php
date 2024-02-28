<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name'=> 'required|string',
            'email'=>'required|email|unique:users',
            'roles'=>'required',
            'is_active'=>'required',
            'password'=>'required'
        ];
    }

    public function messages(){
        return[
          'email.required'=> 'Email is required',
            'name.required'=>'Name is required',
            'password.required'=>'Password is required'
        ];
    }
}
