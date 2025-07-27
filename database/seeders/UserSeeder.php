<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();
        User::factory()->count(2)->has(

            Ticket::factory()->count(random_int(2, 5))->has(
                Message::factory()->count(random_int(1, 5))
                    ->sequence(function ($sequence) use ($faker) {
                        return [
                            'sender_type' => $sequence->index === 0 ? 'customer' : $faker->randomElement(['customer', 'agent']),
                        ];
                    })
            )->state(['token' => fn () => Str::uuid()->toString()])
        )->create([
            'password' => 'password',
        ]);
    }
}
