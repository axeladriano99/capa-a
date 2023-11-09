<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StorePaymentMethodPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('has_permissions', ['Métodos de pago', 'Crear']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'        => 'required|string|max:255|unique:payment_methods,name',
            'code'        => 'required|string|max:50|unique:payment_methods,code',
            'description' => 'nullable|string|max:255',
            'country_id'  => 'required|exists:countries,id',
        ];
    }
}
