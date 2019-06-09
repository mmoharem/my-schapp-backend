<?php

namespace App\Traits;

use App\Models\Student;
use App\User;
use Illuminate\Http\Request;

class ApiSearch
{
    public static function apply(Request $filters) {
        $user = (new User)->newQuery();

//        if($filters->filled('lastName')) {
//            $user->where('lastName', $filters->lastName);
//        }
//
//        if($filters->filled('firstName')) {
//            $user->where('firstName', $filters->firstName);
//        }
//
//        if($filters->filled('birthDate')) {
//            $user->where('birthDate', $filters->birthDate);
//        }
//
//        if($filters->filled('grade_id')) {
//
//        }
        return $user->get();
//        return $user->student()->get();
    }

    public static function applyStudent(Request $filters) {

        $user = (new User)->newQuery();

        if($filters->filled('lastName')) {
            $user->where('lastName', $filters->lastName);
        }

        if($filters->filled('firstName')) {
            $user->where('firstName', $filters->firstName);
        }

        if($filters->filled('birthDate')) {
            $user->where('birthDate', $filters->birthDate);
        }

        if($filters->filled('grade_id')) {
            $user->whereHas('student', function ($query) use ($filters){
                $query->whereIn('students.grade_id', [$filters->grade_id]);
            });
        }

        $user->whereHas('student')->with('images', 'student.grade.fees', 'student.payment');

//        $user->whereHas('student')->with('student.grade.fees', 'student.payment')
//        ;

        return $user->get();
//        return $user;
    }

    public static function applyEmployee(Request $filters) {

        $user = (new User)->newQuery();

        if($filters->filled('lastName')) {
            $user->where('lastName', $filters->lastName);
        }

        if($filters->filled('firstName')) {
            $user->where('firstName', $filters->firstName);
        }

        if($filters->filled('birthDate')) {
            $user->where('birthDate', $filters->birthDate);
        }

//        if($filters->filled('grade_id')) {
//            $user->whereHas('student', function ($query) use ($filters){
//                $query->whereIn('students.grade_id', [$filters->grade_id]);
//            });
//        }

        $user->whereHas('employee')->with('images', 'employee');

//        $user->whereHas('student')->with('student.grade.fees', 'student.payment')
//        ;

        return $user->get();
//        return $user;
    }
}