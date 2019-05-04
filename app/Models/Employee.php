<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'profession', 'salary', 'reg_date', 'experience'
    ];

    public function users() {
        return $this->hasMany(User::class, 'user_id');
    }
}
