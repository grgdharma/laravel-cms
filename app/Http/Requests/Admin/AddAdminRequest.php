<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class AddAdminRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'      => 'required|max:255',
            'email'     => 'required|email|unique:admins',
            'role'      => 'required',
            'password'  => 'required|min:5',
        ];
    }
    public function messages()
    {
        return [
            'name.required'     => 'The name filed is required.',
            'email.required'    => 'The email field is required.',
            'role.required'     => 'The role field is required.',
            'password.required' => 'The password field is required.'
        ];
    }
}
