<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('domains.{userId}', function (User $user, $userId) {
    return (int)$user->id === (int)$userId;
});
