<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegisterPost extends FormRequest
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
            'name'              => 'required|string|max:255',
            'email'             => 'required|email:filter|unique:users,email',
            'phone'             => 'required|string|max:20',
            'password'          => 'required|confirmed',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'payment_data'      => 'required|string|max:50',
        ];
    }

    protected function prepareForValidation()
    {
        $invitation = \App\Models\CampaignInvitation::where([
            ['code', $this->code],
            ['used', false]
        ])->first();
        
        $this->merge([
            'email' => $invitation?->email,
            'email_verified_at' => now(),
        ]);
    }
}
