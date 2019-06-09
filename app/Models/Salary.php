<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'base_salary', 'tot_extras', 'to_pay'
    ];

    public function employee() {
        return $this->hasOne(Employee::class, 'salary_id');
    }
}
