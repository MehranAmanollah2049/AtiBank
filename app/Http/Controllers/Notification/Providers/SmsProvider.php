<?php

namespace App\Http\Controllers\Notification\Providers;

use App\Models\User;

class SmsProvider
{

    private $phoneNumber;
    private $text;
    private $BodyId;

    public function __construct($phoneNumber = null, string $text = null, $BodyId = null)
    {
        $this->phoneNumber = $phoneNumber;
        $this->text = $text;
        $this->BodyId = $BodyId;
    }


    public function send()
    {

        $data = $this->prepareData();
        $post_data = http_build_query($data);
        $handle = curl_init(config('services.sms.link'));
        curl_setopt($handle, CURLOPT_HTTPHEADER, array(
            'content-type' => 'application/x-www-form-urlencoded'
        ));
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
        $response = curl_exec($handle);
        return true;
    }


    private function prepareData()
    {

        return array_merge(
            config('services.sms.auth'),
            [
                'text' => $this->text,
                'to' => $this->phoneNumber,
                'bodyId' => $this->BodyId,
            ]
        );
    }

    public function generateCode() {

        return rand(10000,99999);
    }
}
