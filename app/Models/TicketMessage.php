<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'sender_id',
        'receiver_id',
        'ticket_id',
        'message',
        'read_at',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
    
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function media()
    {
    return $this->hasMany(TicketMessageMedia::class,'message_id');
    }
}
