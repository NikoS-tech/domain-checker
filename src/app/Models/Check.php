<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $domain_id
 * @property string|null $name
 * @property int $interval_seconds
 * @property int $timeout_seconds
 * @property string $method
 * @property Carbon|null $last_run_at
 * @property-read Domain|null $domain
 */
class Check extends Model
{
    protected $fillable = ['domain_id', 'name', 'interval_seconds', 'timeout_seconds', 'method', 'last_run_at'];

    protected $casts = ['last_run_at' => 'datetime'];

    public function domain(): BelongsTo
    {
        return $this->belongsTo(Domain::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(CheckResult::class);
    }

    public function latestResult(): HasOne
    {
        return $this->hasOne(CheckResult::class)->latestOfMany();
    }

    public function label(): string
    {
        return $this->name ?: $this->method;
    }
}
