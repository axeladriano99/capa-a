<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'percent', 'value', 'currency', 'duration', 'payment_method_id', 'reference_method', 'country_id'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function invitations()
    {
        return $this->hasMany(CampaignInvitation::class);
    }
    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
