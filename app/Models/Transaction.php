<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static find($id)
 * @method static create(array $array)
 * @method static findOrFail($id)
 * @property mixed $id
 */
class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $guarded = [];

    public function getPendingCount()
    {
        return Transaction::with('user')->where('status', 'pending')->count();
    }
    public function getTransactions()
    {
        return $this->with('user')->paginate(5);
    }

    public function purpose()
    {
        return $this->hasOne(Purpose::class, 'purpose_id', 'purpose_id');
    }

    /**
     * @return HasOne
     */
    public function document(): HasOne
    {
        return $this->hasOne(Document::class, 'document_id', 'doc_type_id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
