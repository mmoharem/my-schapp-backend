<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'filename', 'mime', 'original_filename', 'image_type'
    ];

    public function users() {
        return $this->morphedByMany(User::class, 'imageable');
    }
}
