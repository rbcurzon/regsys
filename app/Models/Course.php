<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find($course_id)
 * @method static insert(array[] $programs)
 */
class Course extends Model
{
    use HasFactory;
    protected $primaryKey = 'course_id';

    public function users()
    {
        return $this->hasMany(User::class, 'course_id', 'course_id');
    }
}
