<?php

namespace Database\Factories;

use App\Models\Document;
use App\Models\Purpose;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = ['pending', 'processing', 'releasing'];
        return [
            'user_id' => fake()->numberBetween(1, 10),
            'requested_date' => fake()->date(),
            'needed_date' => fake()->date(),
            'purpose_id' => Purpose::inRandomOrder()->first()->purpose_id,
            'doc_type_id' => Document::inRandomOrder()->first()->document_id,
            'status' => $status[array_rand($status)],
            ];
    }
}
