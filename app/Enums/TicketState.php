<?php

namespace App\Enums;

enum TicketState: string
{
    case PENDING = 'pending';
    case ASSIGNED = 'assigned';
    case OPENED = 'opened';
    case WORKING = 'working';
    case CLOSED = 'closed';
}
