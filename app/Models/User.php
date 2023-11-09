<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'reference_method',
        'payment_method_id',
        'payment_data',
        'role_id',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%'.$search.'%')
            
            ->orWhere('email', 'like', '%'.$search.'%')
            ->orWhereHas('role', function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%');
            });
        });
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class,'campaign_referrals', 'referred_id');
    }

    public function invitations()
    {
        return $this->hasMany(CampaignInvitation::class);
    }

    public function referrals()
    {
        return $this->hasMany(CampaignReferral::class, 'referred_by_id');
    }

    public function campaign_referrals()
    {
        return $this->hasMany(CampaignReferral::class, 'referred_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function payments_received()
    {
        return $this->hasMany(Payment::class, 'to_user_id');
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
