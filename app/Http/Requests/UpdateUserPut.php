<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateUserPut extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('has_permissions', ['Usuarios', 'Editar']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'             => 'required|string|max:255',
            'email'            => 'required|email:filter|max:255|unique:users,email,'.$this->user->id.'id',
            'phone'            => 'required|string|max:20',
            //'reference_method' => 'required|string|max:100',
            'role_id'          => 'required|exists:roles,id',
            'password'         => 'nullable|confirmed',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'payment_data'      => 'required',
        ];
    }
}
