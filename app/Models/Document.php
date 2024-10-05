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

    public function getDocuments()
    {
        return Document::with('transactions');
    }
    public function transactions()
    {
        $this->belongsToMany(Transaction::class,$table="transactions" ,$foreignPivotKey = 'doc_type_id', $relatedPivotKey = 'document_id');
    }
}
