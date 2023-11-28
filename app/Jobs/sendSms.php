<?php

namespace App\Jobs;

use App\Http\Controllers\Notification\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class sendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $PhoneNumber;
    public $Text;
    public $BodyId;

    /**
     * Create a new job instance.
     */
    public function __construct($phoneNumber, $text, $bodyId)
    {

        $this->PhoneNumber = $phoneNumber;
        $this->Text = $text;
        $this->BodyId = $bodyId;
        $notification = new Notification();
        $notification->sendSms($this->PhoneNumber,$this->Text,$this->BodyId); 
    }

    /**
     * Execute the job.
     */
    public function handle(Notification $notification)
    {
        //  $notification->sendSms($this->PhoneNumber,$this->Text,$this->BodyId); 
        //  return true;
    }
}
