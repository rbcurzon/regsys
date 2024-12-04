<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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

    public function getTransactions()
    {
        $status = ['on process', 'for release', 'pending'];
        return collect(
            $this::with('user')
                ->whereIn('status', $status)
                ->get())
            ->sortBy('needed_date')
            ->paginate(5);
    }

    public function getRevenue()
    {
        $paid_transactions = $this->with('user')->where('is_paid', '=', '1')->get();
        $sum = 0;

        foreach ($paid_transactions as $transaction) {
            $sum += $transaction->document->cost;
        }

        return $sum;
    }

    public function isPaid()
    {
        return !($this->is_paid == '0');
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function getPaidTransactionsCount()
    {
        return $this->with('user')->where('is_paid', '=', '1')->count();
    }

    public function setPaid(bool $paid)
    {
        $this->is_paid = $paid;
        $this->save();
    }

    public function getOnProcessTransaction()
    {
        $status = ['on process', 'for release'];
        return $this->wherein('status', $status)->get();
    }

    public function getReleasedCount()
    {
        return $this->where('status', 'released')->count();
    }

    public function getOnProcessCount()
    {
        $status = ['on process', 'for release'];
        return $this->wherein('status', $status)->count();
    }

    public function getPendingCount(): int
    {
        return $this->with('user')->where('status', 'pending')->count();
    }

//    public function getTransactions(): LengthAwarePaginator
//    {
//        $status = ['on process', 'for release', 'pending', 'rejected'];
//        return $this->with('user')
//            ->whereIn('status', $status)
//            ->orderBy('needed_date', 'asc')
//            ->orderBy('requested_date', 'asc')
//            ->paginate(5);
//    }

    public function getTotalCost()
    {
        $cost = 0;
        $requests = $this->transactionDocument;

        foreach ($requests as $request) {
            $cost += $request->document->cost;
        }

        return $cost;
    }

    public function getDocumentIds()
    {
        $transaction_document = $this->transactionDocument()->get();
        $document_ids = [];

        foreach ($transaction_document as $document) {
            $document_ids[] = $document->document_id;
        }

        return $document_ids;
    }

    public function window(): int
    {
        $department = $this->user->course->department;

        if ($department == 'DTE') {
            return 1;
        } else if ($department == 'DCI') {

            return 2;
        } else if ($department == 'DBA') {

            return 3;
        } else if ($department == 'DAS') {

            return 4;
        }

        return -1;
    }

    public function setIs_paid(bool $is_paid)
    {
        $this->is_paid = $is_paid;
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

    public function transactionDocument(): HasMany
    {
        return $this->hasMany(TransactionDocument::class, 'transaction_id', 'id');
    }
}
