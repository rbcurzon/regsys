<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static insert(array[] $document_lists)
 * @method static find($type_id)
 */
class Document extends Model
{
    use HasFactory;

    protected $primaryKey = 'document_id';

    public function getCost()
    {
        return $this->cost;
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'document_id', 'document_id');
    }

    public function transaction_document()
    {
        return $this->belongsTo(TransactionDocument::class, 'document_id', 'document_id');
    }
}
