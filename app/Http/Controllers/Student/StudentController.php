<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\ApiController;
use App\Models\Image;
use App\Models\Student;
use App\Models\ShGrade;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Support\Facades\File;
use \Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$students = User::whereHas('student')->with('student')->get();

        $student = Student::with('user.images', 'grade.fees')->get();

        return $this->showAll($student);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'address' => $request->address,
            'gender' => $request->gender,
            'birthDate' => $request->birthDate,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'mobilePhone' => $request->mobilePhone,
            'medicalState' => $request->medicalState,
            'notes' => $request->notes,
            'password' => Hash::make($request->password),

        ]);

        $student = new Student([
            'class' => $request->class,
//            'grade_id' => $request->grade,
//             'grade_id' => 'kg-2',
//            'class' => 'kg-2c',

        ]);
//
        $user->student()->save($student);

        $grade = ShGrade::findOrFail($request->grade);

        $student->grade()->associate($grade)->save();

//        return response()->json(['data' => $student], 201);
        return $this->showOne($student, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        $student =  $user->student;

//        return response()->json(['data' => $student], 200);
        return $this->showOne($student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $image = Image::findOrFail($request->image_id);

        $student = Student::findOrFail($id);

        $user = $student->user;

        $user->images()->save($image);

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
