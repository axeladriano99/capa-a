<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateCampaignPut extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('has_permissions', ['Campañas', 'Editar']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'currency'          => 'required|string|max:100',
            'name'              => 'required|string|max:255',
            'percent'           => 'required|numeric|max:100',
            'value'             => 'required|numeric',
            'duration'          => 'required|integer',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'reference_method'  => 'required|string|max:50',
            'country_id'        => 'required|exists:countries,id',
        ];
    }
}
