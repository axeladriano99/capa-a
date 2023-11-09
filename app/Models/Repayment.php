<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repayment extends Model
{
    use HasFactory;
    protected $fillable = ['campaign_id', 'from_user_id', 'to_user_id', 'cycle', 'total', 'received', 'repayment', 'pending'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function to()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }
}
