<?php

namespace App\Contracts;

use App\Models\User;

interface TicketAssignerInterface
{
    public function getNextAgent(): User;
}
