<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'profession', 'insurance_state', 'reg_date', 'experience'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function salary() {
        return $this->belongsTo(Salary::class);
    }

    public function teacher() {
        return $this->hasOne(Teacher::class, 'employ_id');
    }
}
