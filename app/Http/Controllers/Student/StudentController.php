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
use App\Http\Requests\StudentCreateRequest;

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
//        $student = $this->studentRepo->with(['user.images', 'grade.fees', 'payment'])->get();

        $student = $this->userRepo->whereWith('student', ['images', 'student.grade.fees', 'student.payment'])->get();

        return $this->showAll($student);
//        return $s;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRegisterRequest $request)
    {
        $user = $this->userRepo->createUpdate($request->only($this->userRepo->getModel()->fillable));

        $image = $this->imgRepo->find($request->image_id);
        $user->images()->save($image);

        $student = $this->studentRepo->createUpdate($request->only($this->studentRepo->getModel()->fillable));

        $user->student()->save($student);

        $grade = $this->gradeRepo->find($request->grade_id);
        $student->grade()->associate($grade)->save();

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

        $user = $this->userRepo->find($id);

//        $student = $this->userRepo->whereWith('student', ['images', 'student.grade.fees', 'student.payment'])->get();

//        $student = $user->students()->whereHas('student')->with('images', 'student.grade.fees', 'student.payment')->get();
        $student = $user->student;

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
