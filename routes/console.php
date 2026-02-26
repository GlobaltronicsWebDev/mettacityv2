<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule automated security tasks
Schedule::command('security:audit')->daily()->at('02:00');
Schedule::command('security:monitor')->hourly();
Schedule::command('db:backup')->daily()->at('03:00');
Schedule::command('db:backup --keep=30')->weekly()->sundays()->at('04:00'); // Weekly full backup
