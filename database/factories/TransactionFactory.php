<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
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
        $year_level = fake()->numberBetween(1, 5);
        $course = \App\Models\Course::inRandomOrder()->first();
        return [
            'user_id' => fake()->numberBetween(1, 10),
            'name' => fake()->name(),
            'course_id' => $course->course_id,
            'section' => $year_level . '-' . $course->code,
            'year_level' => $year_level,
            'date_requested' => fake()->date(),
            'date_needed' => fake()->date(),
            'purpose_id' => \App\Models\Purpose::inRandomOrder()->first()->purpose_id,
            'type_id' => \App\Models\Document::inRandomOrder()->first()->document_id,
            'status' => $status[array_rand($status)],
            ];
    }
}
