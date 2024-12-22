<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event;


class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id', 'user_id', 'quantity', 'status',
    ];

    /**
     * Define the relationship to an event.
     */
    
     public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

     public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
    public function getQrCodeUrlAttribute()
{
    return route('admin.tickets.qrCode', ['ticket' => $this->id]);
}

}
