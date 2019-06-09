<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'material'
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function classes() {
        return $this->belongsToMany(ShClass::class);
    }
}
