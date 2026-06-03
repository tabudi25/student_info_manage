<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class StudentModel extends Model
{
    protected $table = 'student';
    protected $fillable = ['first_name', 'last_name', 'email', 'gender', 'phone', 'address', 'course', 'year'];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
