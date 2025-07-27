<?php

use App\Models\User;
use App\Services\SimpleTicketAssigner;

test('RoundRobin Ticket Assigner will returns a User object instance ', function () {
    User::factory()->count(3)->create();
    $rrTicketAssigner = new SimpleTicketAssigner();
    expect($rrTicketAssigner->getNextAgent())->toBeInstanceOf(User::class);
});
