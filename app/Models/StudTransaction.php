<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudTransaction extends Model
{
    protected $fillable = ['type', 'amount'];

    public function student() {
        return $this->belongsTo(Student::class);
    }
}
