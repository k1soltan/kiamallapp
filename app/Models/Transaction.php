<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['user_balance_id', 'type', 'amount'];

    // Relationship: Link to the user's balance
    public function userBalance()
    {
        return $this->belongsTo(UserBalance::class);
    }
}
