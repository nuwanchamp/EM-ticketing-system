<?php

namespace App\Services;

use App\Contracts\TicketAssignerInterface;
use App\Models\User;

class SimpleTicketAssigner implements TicketAssignerInterface
{
    /**
     * @throws \Throwable
     */
    public function getNextAgent(): User
    {
        return throw_unless(User::first(), new \RuntimeException('No agents available', 500));
    }
}
