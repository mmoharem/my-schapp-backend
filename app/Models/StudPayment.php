<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudPayment extends Model
{
    protected $fillable = ['total_payments', 'tot_paid_fees', 'to_pay_fees'];

    public function student() {
        return $this->belongsTo(Student::class);
    }
}
