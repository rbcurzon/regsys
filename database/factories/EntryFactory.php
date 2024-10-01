<?php

namespace Database\Factories;

use App\Models\Entry;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Entry>
 */
class EntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'transaction_id' => Transaction::inRandomOrder()->first()->id,
            'amount' => $this->faker->numberBetween(3, 100),
            ];
    }
}
