<?php

namespace App\Console\Commands;

use App\Models\Check;
use App\Services\CheckRunner;
use Illuminate\Console\Command;

class RunChecks extends Command
{
    protected $signature = 'checks:run';

    protected $description = 'Run domain checks that are due';

    public function handle(CheckRunner $runner): int
    {
        Check::with('domain')->get()->each(function (Check $check) use ($runner) {
            if ($check->last_run_at && $check->last_run_at->addSeconds($check->interval_seconds)->isFuture()) {
                return;
            }

            $runner->run($check);
        });

        return self::SUCCESS;
    }
}
