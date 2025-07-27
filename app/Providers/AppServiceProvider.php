<?php

namespace App\Providers;

use App\Contracts\TicketAssignerInterface;
use App\Events\TicketCreated;
use App\Listeners\SendTicketAcknowledgement;
use App\Models\Ticket;
use App\Models\User;
use App\Services\SimpleTicketAssigner;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(TicketAssignerInterface::class, config('ticketing.ticket_assigner', SimpleTicketAssigner::class));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Logged-in user considered as agents
        Gate::define('view-ticket',
            fn (User $user, Ticket $ticket) => $user->id === (int) $ticket->user_id);

        Event::listen(TicketCreated::class, SendTicketAcknowledgement::class);

    }
}
