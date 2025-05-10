<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Jobs\RunAuctionJob;
// use Illuminate\Console\Scheduling\Schedule;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');



Schedule::command('auction:update-schedule')->weekly();
Schedule::command('app:finish-insurance-monthly')->monthly();
Schedule::command('app:finish-insurance-yearly')->yearly();



return function (Schedule $schedule) {
    $schedule->job(new RunAuctionJob())->everyMinute();
};
