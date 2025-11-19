<?php

namespace App\Policies;

use App\Models\Gig;
use App\Models\User;

class GigPolicy
{
    public function update(User $user, Gig $gig): bool
    {
        return $user->id === $gig->seller_id;
    }

    public function delete(User $user, Gig $gig): bool
    {
        return $user->id === $gig->seller_id;
    }
}