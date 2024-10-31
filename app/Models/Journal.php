<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $primaryKey = 'journal_id';

    protected $guarded = [];

    public function getTotalDebit()
    {
        return $this->isBalance() ? $this->where('is_credit',0)->sum('cost') : -1;
    }
    public function isBalance()
    {
        $difference = $this
            ->selectRaw('sum(case when is_credit = 1 then cost else 0 end) as credit_total, sum(case when is_credit = 0 then cost else 0 end) as debit_total')
            ->first();

        return ($difference->credit_total - $difference->debit_total) == 0;
    }
}
