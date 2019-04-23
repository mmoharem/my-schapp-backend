<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShGrade extends Model
{
    protected $fillable = ['name', 'level'];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function students() {
        return $this->hasOne(Student::class, 'grade_id');
    }

    public function fees() {
        return $this->hasOne(SchFees::class, 'grade_id');
    }
}
