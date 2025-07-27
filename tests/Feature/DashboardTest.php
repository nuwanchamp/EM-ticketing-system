<?php

use App\Livewire\Admin\Dashboard;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Livewire;

it('will redirect guests to the login page', function () {
    $this->get('/admin/dashboard')->assertRedirect('/login');
});

it('will allow authenticated users to visit the dashboard', function () {
    $this->actingAs($user = User::factory()->create());
    $this->get('/admin/dashboard')->assertStatus(200);
});
it('will only show ticket related to logged in agent', function () {
    $user = User::factory(2)->create();
    Ticket::factory()->count(2)->create(['user_id' => 1, 'token' => fn () => Str::uuid()->toString()]);
    $firstUser = $user->first();
    $lastUser = $user->last();
    $this->actingAs($firstUser);

    $livewire = Livewire::test(Dashboard::class);

    expect($livewire->assignedTickets)->toHaveCount(2);
    $this->actingAs($lastUser);
    $livewire = Livewire::test(Dashboard::class);
    expect($livewire->assignedTickets)->toBeEmpty();

});

it('will filter tickets by customer name only belongs to logged in agent', function () {
    config()->set('app.pagination.per_page', 5);

    $users = User::factory(2)->has(
        Ticket::factory()->count(3)->state(['name' => 'John Doe', 'token' => fn () => Str::uuid()->toString()])
    )->create();
    $this->actingAs($users->first());
    $livewire = Livewire::test(Dashboard::class)
        ->set('search', 'John');

    expect($livewire->assignedTickets)->toHaveCount(3);
});
