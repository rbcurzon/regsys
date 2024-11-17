<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDocument extends Model
{
    protected $table = 'transaction_document';

    protected $guarded = [];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
