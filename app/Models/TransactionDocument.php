<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TransactionDocument extends Model
{
    use HasFactory;

    protected $table = 'transaction_document';

    protected $guarded = [];

//    public function computePrice()
//    {
//        $this->price = $this->getQuantity() * $this->document->getCost();
//
//        return $this->save();
//    }

    public function test($id)
    {
        return $this->where('document_id','=',$id)->first()->quantity;
    }

    public function getCost()
    {
        $cost = 0;

        $documents = $this->with('document')->where('transaction_id', '=', 19)->get();
        foreach ($documents as $document) {
            $cost = $cost + $document->cost;
        }

        return $cost;
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function document(): HasOne
    {
        return $this->hasOne(Document::class, 'document_id', 'document_id');
    }
}
