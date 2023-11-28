<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = ['sender','receiver','ticket_text','ticket_image','sender_text','receiver_text','seen','job_id'];

    // get user sender
    public function user_sender()
    {

        return $this->belongsTo(User::class, 'sender');
    }

    // get user receiver
    public function user_receiver()
    {

        return $this->belongsTo(User::class, 'receiver');
    }


    // get job sender
    public function job_sender()
    {

        return $this->belongsTo(Job::class, 'sender')->where("status" , "تایید شده");
    }

    // get job receiver
    public function job_receiver()
    {

        return $this->belongsTo(Job::class, 'receiver')->where("status" , "تایید شده");
    }
}
