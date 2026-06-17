<?php

use App\Console\Commands\RunChecks;
use Illuminate\Support\Facades\Schedule;

Schedule::command(RunChecks::class)->everyMinute()->withoutOverlapping();
