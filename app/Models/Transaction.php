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

    public function getReleasedCount()
    {
        return $this->where('status', 'released')->count();
    }
    public function getOnProcessCount()
    {
        $status = ['processing', 'releasing', 'paid'];
        return $this->wherein('status', $status)->count();
    }
    public function getPendingCount()
    {
        return $this->with('user')->where('status', 'pending')->count();
    }
    public function getUnreleasedTransactions()
    {
        return $this->with('user')->whereNotLike('status', '%released%')->orderBy('requested_date', 'asc')->paginate(5);
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
        return $this->hasOne(Document::class, 'document_id', 'document_id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id', 'student_id');
    }
}
