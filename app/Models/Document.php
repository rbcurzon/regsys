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
}