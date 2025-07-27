<?php

namespace App\Livewire\Admin;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * @property Collection | LengthAwarePaginator $assignedTickets;
 */
class Dashboard extends Component
{
    use WithPagination;

    public string $search = '';

    public function updateSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }

    public function getAssignedTicketsProperty(): Collection|LengthAwarePaginator
    {
        $user = auth()->user();

        if ($user && method_exists($user, 'tickets')) {
            $query = $user->tickets();
            if ($this->search) {
                $query->where('name', 'like', '%'.$this->search.'%');
            }

            return $query->paginate(config('app.pagination.per_page', 10));

        }

        return collect();

    }

    public function navigateToTicket($uuid): void
    {
        $this->redirect(route('ticket.placed', ['uuid' => $uuid]));
    }
}
