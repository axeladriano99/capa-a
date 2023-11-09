<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdatePaymentMethodPut extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('has_permissions', ['Métodos de pago', 'Editar']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:payment_methods,name,'.$this->payment_method->id.',id',
            'code' => 'required|string|max:50|unique:payment_methods,code,'.$this->payment_method->id.',id',
            'description' => 'nullable|string|max:255',
            'country_id'  => 'required|exists:countries,id',
        ];
    }
}
