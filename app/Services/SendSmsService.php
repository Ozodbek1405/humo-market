<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class SendSmsService
{
    public static function sms_packages($phone_number, $message): void
    {
        try {
            SmsSend::send($phone_number, $message);
        }
        catch (\Exception $e) {
            Log::debug($e);
        }
    }
}