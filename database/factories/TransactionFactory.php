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
        $status = ['pending', 'on process', 'releasing', 'released'];
        return [
            'student_id' => User::inRandomOrder()->first()->student_id,
            'requested_date' => fake()->dateTimeBetween('-1 years', 'now')->format('Y-m-d'),
            'needed_date' => fake()->dateTimeBetween('tomorrow', '+5 days')->format('Y-m-d'),
            'purpose_id' => Purpose::inRandomOrder()->first()->purpose_id,
            'is_paid' => fake()->boolean(0),
            'cost' => 0,
            'status' => $status[array_rand($status)],
            ];
    }
}
