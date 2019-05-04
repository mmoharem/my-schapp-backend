<?php

namespace App\Models;


use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'class', 'grade_id', 'user_id'
    ];
    public function  User() {
        return $this->belongsTo(User::class);
    }

    public function grade() {
        return $this->belongsTo(ShGrade::class);
    }

    public function transactions() {
        return $this->hasMany(StudTransaction::class, 'student_id');
    }

    public function payment() {
        return $this->hasOne(StudPayment::class, 'student_id');
    }

    public function attendances() {
        return $this->hasMany(StudAttendance::class, ('student_id'));
    }


    //
    public function checkIn($attend) {
        $day = Carbon::now('GMT+2')->format('Y-m-d');
//        $now = $this->freshTimestamp();
//        $day = $now->format('Y-m-d');


//        $any = $this->attendances()->where('student_id', '3')->first();

        return $this->attendances()->create([
            'attend' => $attend,
            'day' => $day
        ]);

    }
}
