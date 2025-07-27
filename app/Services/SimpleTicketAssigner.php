<?php

namespace App\Services;

use App\Contracts\TicketAssignerInterface;
use App\Models\User;

class SimpleTicketAssigner implements TicketAssignerInterface
{
    public function getNextAgent(): User
    {
        return User::first();
    }
}
