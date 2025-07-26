<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ticket_id' => Ticket::factory(),
            'sender_type' => $this->faker->randomElement(['customer', 'agent']),
            'content' => $this->faker->paragraph(),
            'created_at' => now(),
        ];
    }
}
