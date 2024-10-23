<?php

namespace Database\Factories;

use App\Models\Document;
use App\Models\Purpose;
use App\Models\Transaction;
use App\Models\User;
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
        $status = ['pending', 'processing', 'releasing', 'released', 'rejected'];
        return [
            'student_id' => User::inRandomOrder()->first()->student_id,
            'requested_date' => fake()->dateTimeBetween('-1 years', 'now')->format('Y-m-d'),
            'needed_date' => fake()->dateTimeBetween('now', '+1  years')->format('Y-m-d'),
            'purpose_id' => Purpose::inRandomOrder()->first()->purpose_id,
            'document_id' => Document::inRandomOrder()->first()->document_id,
            'is_paid' => fake()->boolean(),
            'status' => $status[array_rand($status)],
            ];
    }
}
