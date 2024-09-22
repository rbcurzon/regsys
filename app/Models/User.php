<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

//    protected $primaryKey = 'user_id';
    public function getTransactions() {
        if (Auth::user()->isAdmin)
        {
            $transactions = Transaction::query()
                ->select('*')
                ->paginate(5);
            return $transactions;
        }
        else if (Auth::user()->isAdmin == false)
        {
            $transactions = Transaction::query()
                ->select('*')
                ->where('user_id', Auth::id())
                ->paginate(5);
            return $transactions;
        }
    }



    public function transaction()
    {
        return $this->hasMany(Transaction::class);
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
