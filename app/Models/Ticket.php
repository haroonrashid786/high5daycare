<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'sender_id',
        'receiver_id',
        'reason_id',
        'ticket_id',
        'subject',
        'description',
        'status',
        'sender_rating', 'sender_feedback', 
        'receiver_rating', 'receiver_feedback',
    ];


    public function messages()
    {
        return $this->hasMany(TicketMessage::class,'ticket_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'ticket_users', 'ticket_id', 'user_id');
    }

    public function lastMessage()
    {
        return $this->hasOne(TicketMessage::class,'ticket_id','id')->latest();
    }

    public function reason()
    {
        return $this->hasOne(TicketReason::class, 'id', 'reason_id');
    }


}
