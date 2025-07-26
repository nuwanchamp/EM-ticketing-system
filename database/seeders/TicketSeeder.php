<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\Ticket as TicketModel;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();
        TicketModel::factory()->count(2)->has(
            Message::factory()->count(random_int(1, 5))
                ->sequence(function ($sequence) use ($faker) {
                    return [
                        'sender_type' => $sequence->index === 0 ? 'customer' : $faker->randomElement(['customer', 'agent']),
                    ];
                })
        )->create(['token' => fn () => Str::uuid()->toString()]);
    }
}
