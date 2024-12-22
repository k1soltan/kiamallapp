<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBalance extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'balance_id', 'amount', 'used_amount', 'expires_at'];

    // Relationship: Link to the balance type
    public function balance()
    {
        return $this->belongsTo(Balance::class);
    }

    // Relationship: Transactions for this user's balance
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
