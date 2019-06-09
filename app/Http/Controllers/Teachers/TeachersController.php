<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Requests\EmployeeRegRequest;
use App\Http\Requests\TeacherRegRequest;
use App\Models\Teacher;
use App\Repositories\BaseRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class TeachersController extends ApiController
{
    private $employeeController;
    private $teacherRepo;
    private $userRepo;

    public function __construct
    (
        EmployeeController $employeeController,
        Teacher $teacher,
        User $user
    )
    {
        $this->employeeController = $employeeController;
        $this->teacherRepo = new BaseRepository($teacher);
        $this->userRepo = new BaseRepository($user);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $user = app(EmployeeController::class)->index();
//        $employee = $this->employeeController->index();
        $teachers = $this->userRepo->whereWith('employee.teacher', ['employee.teacher', 'images'])->get();

        return $this->showAll($teachers);
//        return $employee;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherRegRequest $request)
    {
        $employee = $this->employeeController->store($request);
//
        $teacher = $this->teacherRepo->createUpdate($request->only($this->teacherRepo->getModel()->fillable));
//
//        $teacher->employee()->save($employee);
        $employee->teacher()->save($teacher);

        return $this->showOne($teacher, 201);
//        return $employee;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
