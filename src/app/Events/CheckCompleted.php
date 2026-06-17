<?php

namespace App\Events;

use App\Models\CheckResult;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CheckCompleted implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public CheckResult $result) {}

    public function broadcastOn(): array
    {
        return [new PrivateChannel('domains.' . $this->result->check->domain->user_id)];
    }

    public function broadcastAs(): string
    {
        return 'check.completed';
    }

    public function broadcastWith(): array
    {
        return [
            'domain'        => $this->result->check->domain->url,
            'check'         => $this->result->check->label(),
            'status'        => $this->result->status,
            'status_code'   => $this->result->status_code,
            'response_time' => $this->result->response_time,
            'created_at'    => $this->result->created_at->toDateTimeString(),
        ];
    }
}
