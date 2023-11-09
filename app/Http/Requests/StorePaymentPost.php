<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
class StorePaymentPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('has_permissions', ['Gestionar pagos', 'Crear']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'campaign_referral_id' => 'required|exists:campaign_referrals,id',
            'comment'              => 'nullable|string|max:255',
            'evidence'             => 'required|file|mimes:jpg,jpeg,png,pdf',
            'to_user_id'           => 'required|exists:users,id',
            'amount'               => 'required',
        ];
    }
}
