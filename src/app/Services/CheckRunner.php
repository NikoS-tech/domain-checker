<?php

namespace App\Services;

use App\Events\CheckCompleted;
use App\Models\Check;
use App\Models\CheckResult;
use Throwable;

class CheckRunner
{
    public function __construct(private DomainChecker $checker) {}

    public function run(Check $check): CheckResult
    {
        $result = $check->results()->create($this->checker->check($check));
        $check->update(['last_run_at' => now()]);
        $result->setRelation('check', $check);

        try {
            CheckCompleted::dispatch($result);
        } catch (Throwable $e) {
            report($e);
        }

        return $result;
    }
}
