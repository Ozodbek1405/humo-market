<?php

namespace App\Console\Commands;

use App\Services\SendSmsService;
use Illuminate\Console\Command;

class SmsSendCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sms-send-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        SendSmsService::sms_packages(998945480514,'hello');
    }
}
