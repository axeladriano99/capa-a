<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, Builder};

class CampaignReferral extends Model
{
    use HasFactory;
    protected $fillable = [
        'campaign_id',
        'referred_id',
        'referred_by_id',
        'start_date',
        'level',
    ];

    public function to()
    {
        return $this->belongsTo(User::class, 'referred_id');
    }

    public function from()
    {
        return $this->belongsTo(User::class, 'referred_by_id');
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }


    /*******Relacion infinita********/
    public function referrals()
    {
        return $this->hasMany(CampaignReferral::class, 'referred_by_id', 'referred_id');
    }

    public function children_referrals()
    {
        return $this->hasMany(CampaignReferral::class, 'referred_by_id', 'referred_id')->with('referrals');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function pay_to()
    {
        //Si es el nivel 0 no debe pagar
        if($this->level == 0){
            return null;
        }


        //Si el nivel es menor que 4 debe pagar al nivel 0
        if($this->level < 4){
            $cr = CampaignReferral::where([
                ['campaign_id', $this->campaign_id],
                ['level' , 0],
                ['status' , 1]
            ])->first();
            return User::find($cr->referred_id);
        }

        //Si el nivel es mayor que 3 debe pagar 3 niveles arriba
        $p1 = CampaignReferral::where([
                ['campaign_id', $this->campaign_id],
                ['level' , $this->level - 1],
                ['referred_id', $this->referred_by_id]
            ])->first();

        $p2 = CampaignReferral::where([
                ['campaign_id', $p1->campaign_id],
                ['level' , $p1->level - 1],
                ['referred_id', $p1->referred_by_id]
            ])->first();

        $p3 = CampaignReferral::where([
                ['campaign_id', $p2->campaign_id],
                ['level' , $p2->level - 1],
                ['referred_id', $p2->referred_by_id],
                ['status' , 1]
            ])->first();
        if(is_null($p3)){
            return null;
        }
        return User::find($p3->referred_id);
    }


    public function two_pay_to()
    {
        if($this->level < 4){
            return null;
        }

        $p1 = $this->pay_to();
        $r1 = CampaignReferral::where([
            ['referred_id', $p1->id],
            ['campaign_id', $this->campaign_id],
            ['level', '<', $this->level],
        ])->first();
        return $r1->pay_to();
    }

    public function getParentAttribute()
    {
        if(is_null($this->referred_by_id)){
            return null;
        }

        return CampaignReferral::where([
            ['campaign_id', $this->campaign_id],
            ['referred_id', $this->referred_by_id],
        ])->first();
    }

    public function getTotalPaymentsReceivedAttribute()
    {
        return Payment::whereHas('campaign_referral', function (Builder $query) {
            $query->where('campaign_id', $this->campaign_id);
        })->where([
            ['to_user_id', $this->referred_id],
        ])->sum('amount');
    }

    public function getProfitsAttribute()
    {
        //Como ya no hay devolucion la ganacia es el total de pagos recibidos
        return $this->total_payments_received;


        /*if(is_null($this->referred_by_id)){
            return $this->total_payments_received;
        }

        return Repayment::where([
            ['campaign_id', $this->campaign_id],
            ['from_user_id', $this->referred_id],
        ])->sum('received');*/
    }

    public function getRepaymentPendingAttribute()
    {
        if(is_null($this->referred_by_id)){
            return 0;
        }

        return $this->profits - Repayment::where([
            ['campaign_id', $this->campaign_id],
            ['from_user_id', $this->referred_id],
        ])->sum('repayment');
    }
}
