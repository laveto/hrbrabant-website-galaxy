<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;

class Kernel extends \Galaxy\Core\Console\Kernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('sync:vacancies')->everyFifteenMinutes();

        parent::schedule($schedule);
    }

    protected function commands()
    {
        parent::commands();

        $this->load(__DIR__.'/Commands');
    }
}
