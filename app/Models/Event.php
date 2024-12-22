<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;


class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'details',
        'type',
        'start',
        'end',
        'tickets_available',
        'quantity',
    ];

    public function isTask()
    {
        return $this->type === 'task';
    }

    public function isEvent()
    {
        return $this->type === 'event';
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    
    
}
