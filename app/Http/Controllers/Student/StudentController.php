<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\ApiController;
use App\Http\Requests\StudentRegisterRequest;
use App\Models\Image;
use App\Models\Student;
use App\Models\ShGrade;
use App\Repositories\BaseRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\StudentCreateRequest;
use \Illuminate\Support\Facades\Hash;

class StudentController extends ApiController
{

    private $studentRepo;
    private $userRepo;
    private $gradeRepo;
    private $imgRepo;

    public function __construct
    (
        Student $student,
        User $user,
        ShGrade $grade,
        Image $image
    )
    {
        $this->studentRepo = new BaseRepository($student);
        $this->userRepo = new BaseRepository($user);
        $this->gradeRepo = new BaseRepository($grade);
        $this->imgRepo = new BaseRepository($image);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$students = User::whereHas('student')->with('student')->get();
        //$student = Student::with('user.images', 'grade.fees', 'payment')->get();

        $student = $this->studentRepo->with(['user.images', 'grade.fees', 'payment'])->get();

        return $this->showAll($student);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRegisterRequest $request)
    {
//        $user = User::create([
////            'firstName' => $request->firstName,
////            'lastName' => $request->lastName,
////            'address' => $request->address,
////            'gender' => $request->gender,
////            'birthDate' => $request->birthDate,
////            'email' => $request->email,
////            'phoneNumber' => $request->phoneNumber,
////            'mobilePhone' => $request->mobilePhone,
////            'medicalState' => $request->medicalState,
////            'notes' => $request->notes,
////            'password' => Hash::make($request->password),
////
////        ]);
///
        $user = $this->userRepo->createUpdate($request->only($this->userRepo->getModel()->fillable));

//        $student = new Student([
//            'class' => $request->class,
////            'grade_id' => $request->grade,
////             'grade_id' => 'kg-2',
////            'class' => 'kg-2c',
//
//        ]);

        $image = $this->imgRepo->find($request->image);
        $user->images()->save($image);

        $student = $this->studentRepo->createUpdate($request->only($this->studentRepo->getModel()->fillable));
//
        $user->student()->save($student);

        $grade = $this->gradeRepo->find($request->grade_id);
        $student->grade()->associate($grade)->save();

//        $grade = ShGrade::findOrFail($request->grade);
//        $grade->students()->save(student);
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
        $rules = [

            'image_id' => 'required'
        ];

        $this->validate($request, $rules);

        $student = Student::findOrFail($id);

        $image = Image::findOrFail($request->image_id);

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
        $student = Student::findOrFail($id);

        $user = $student->user;

        $student->delete();
        $user->delete();

        return $student;
    }
}
