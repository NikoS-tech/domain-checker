<?php

namespace App\Policies;

use App\Models\Check;
use App\Models\Domain;
use App\Models\User;

class CheckPolicy
{
    public function create(User $user, Domain $domain): bool
    {
        return $user->id === $domain->user_id;
    }

    public function update(User $user, Check $check): bool
    {
        return $user->id === $check->domain->user_id;
    }

    public function delete(User $user, Check $check): bool
    {
        return $user->id === $check->domain->user_id;
    }

    public function run(User $user, Check $check): bool
    {
        return $user->id === $check->domain->user_id;
    }
}
