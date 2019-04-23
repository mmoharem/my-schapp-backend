<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchFees extends Model
{
    protected $fillable = [
        'old_schFees', 'schFees', 'old_booksFees', 'booksFees', 'old_totFees', 'totFees'
    ];

    public function grade() {
        return $this->belongsTo(ShGrade::class);
    }
}
