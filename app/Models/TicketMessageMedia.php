<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMessageMedia extends Model
{
    use HasFactory;


    protected $fillable=[
        'message_id',
        'path',
        'type',
        ];

        public function message()
    {
            return $this->belongsTo(TicketMessage::class);
    }


}
