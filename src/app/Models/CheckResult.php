<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $check_id
 * @property string $status
 * @property int|null $status_code
 * @property int|null $response_time
 * @property string|null $error
 * @property Carbon|null $created_at
 * @property-read Check|null $check
 */
class CheckResult extends Model
{
    protected $fillable = ['check_id', 'status', 'status_code', 'response_time', 'error'];

    public function check(): BelongsTo
    {
        return $this->belongsTo(Check::class);
    }
}
