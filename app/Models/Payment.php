<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'campaign_id',
        'campaign_referral_id',
        'user_id',
        'to_user_id',
        'amount',
        'status',
        'comment',
        'evidence',
        'type',
    ];

    public function campaign_referral()
    {
        return $this->belongsTo(CampaignReferral::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function to()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    public function from()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getStatusStrAttribute()
    {
        $r = "";
        if($this->status == 0){
            $r = "Pendiente por confirmar";
        }

        if($this->status == 1){
            $r = "Confirmado";
        }

        return $r;
    }

    public function getTypeIconAttribute()
    {
        //return $this->type == 1 ? 'Inicial' : 'Devolución';
        return $this->type == 1 ? '<button class="btn btn-success btn-icon"><i class="wi wi-small-craft-advisory"></i></button>' : '<button class="btn btn-success btn-icon"><i class="wi wi-gale-warning"></i></button>';
        
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('amount', 'like', '%'.$search.'%')
            
            //->orWhere('email', 'like', '%'.$search.'%')
            ->orWhereHas('to', function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%');
            })
            ->orWhereHas('from', function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%');
            });
        });
    }
}
