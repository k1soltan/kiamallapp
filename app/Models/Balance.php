<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'amount', 'use_limit', 'time_limit', 'expiration_date'];

    // Relationship: Users associated with the balance
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_balances');
    }
}
