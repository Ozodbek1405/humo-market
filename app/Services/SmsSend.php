<?php

namespace App\Services;
use Illuminate\Support\Facades\Facade;


class SmsSend extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return EskizSmsClient::class;
    }
}