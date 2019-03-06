<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'email' => 'required|email|max:191|unique:users',
            'password' => 'required|string',
            'fullname' => 'required|string|max:191',
            'tel' => 'string|max:20',
            'address' => 'string|max:191',
        ];
    }
}
