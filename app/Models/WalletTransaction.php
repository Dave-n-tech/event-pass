<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'amount',
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
