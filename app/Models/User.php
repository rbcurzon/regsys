<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;


    public function isNormalUser()
    {
        return $this->role == null;
    }

    /**
     * @return bool
     */
    public function isTreasurer()
    {
        return $this->role == 'treasurer';
    }

    public function isAdmin()
    {
        return $this->role == 'admin';
    }

    /**
     * Get the total number of transactions for the current user
     * @return int
     */

    public function getReleasedCount()
    {
        return $this->transactions->where('status', 'released')->count();
    }
    public function getOnProcessCount()
    {
        $status = ['processing', 'releasing'];
        return $this->transactions->wherein('status', $status)->count();
    }
    public function getPendingCount(): int
    {
        return $this->transactions()
            ->where('status', 'pending')->count();
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getTransactions(): LengthAwarePaginator
    {

        $status = ['processing', 'releasing', 'pending', 'rejected'];
        return $this->transactions()->whereIn('status',$status )
            ->orderBy('needed_date', 'asc')
            ->paginate(5);
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'student_id', 'student_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
