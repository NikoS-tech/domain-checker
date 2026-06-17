<?php

namespace App\Services;

use App\Models\Check;
use Illuminate\Support\Facades\Http;

class DomainChecker
{
    public function check(Check $check): array
    {
        $url = preg_match('#^https?://#i', $check->domain->url) ? $check->domain->url : 'https://' . $check->domain->url;
        $method = strtolower($check->method) === 'head' ? 'head' : 'get';
        $start = microtime(true);

        try {
            $response = Http::timeout($check->timeout_seconds)->{$method}($url);

            return [
                'status'        => $response->successful() ? 'up' : 'down',
                'status_code'   => $response->status(),
                'response_time' => (int)round((microtime(true) - $start) * 1000),
                'error'         => null,
            ];
        } catch (\Throwable $e) {
            return [
                'status'        => 'down',
                'status_code'   => null,
                'response_time' => (int)round((microtime(true) - $start) * 1000),
                'error'         => substr($e->getMessage(), 0, 255),
            ];
        }
    }
}
