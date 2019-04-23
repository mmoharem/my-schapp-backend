<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Traits\ApiSearch;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\ApiController;

class OldSearchController extends ApiController
{
    public function index() {
        return 'index works!';
    }

//    public function filter(Request $request, User $user) {
//        if($request->has('firstName')) {
////            return $user->where('firstName', $request->input('firstName'))->get();
////            return $user->where('firstName', $request->firstName)->get()->collapse();
//        }
//
//        return $user->all();
//    }

//    public function filter(Request $request) {
//        $user = ApiSearch::apply($request);
//
////        $student = Student::where('user_id', $user->id)->get;
//
//        return $user;
//
//    }
//
    public function filter(Request $request) {
        $users = ApiSearch::apply($request);

//        $student = $user->whereHas('student')->get();

//        $user = User::with('student')->get();
//        $user = User::where('firstName', $request->firstName)->with('student.grade.fees')->get();

//        return $student;

//        $id = array();
        $students = collect();

        foreach ($users as $user) {
//            $id[] =  [
//                $user->student()->with('user', 'grade', 'grade.fees')->get()
//            ];
            $students->add($user->student()->with('user.images', 'grade', 'grade.fees')->get());
        }
//        $idd = Arr::collapse($id);

//        $coll = collect($id)->collapse()->collapse();
        $students = collect($students)->collapse();
//        return $users;
        return $this->showAll($students);
    }
}
