<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find($purpose_id)
 * @method static insert(array[] $purpose_lists)
 */
class Purpose extends Model
{
    use HasFactory;

    protected $primaryKey = 'purpose_id';

    public function getPurposes()
    {
        return $this->with('transactions')->get();
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'purpose_id', 'purpose_id');
    }
}
