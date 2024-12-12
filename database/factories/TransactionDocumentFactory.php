<?php

namespace Database\Factories;

use App\Models\Document;
use App\Models\Purpose;
use App\Models\Transaction;
use App\Models\TransactionDocument;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TransactionDocument>
 */
class TransactionDocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = $this->faker->numberBetween(1, 10);
        $document_id = Document::inRandomOrder()->first()->document_id;
        return [
            'transaction_id' => Transaction::inRandomOrder()->first()->id,
            'document_id' => $document_id,
            'quantity' => $quantity,
            'price' => $quantity * Document::find($document_id)->getCost(),
        ];
    }
}
