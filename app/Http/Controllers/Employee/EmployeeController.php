<?php

namespace App\Http\Controllers\Employee;

use App\Http\Requests\EmployeeRegRequest;
use App\Models\Employee;
use App\User;
use App\Models\Image;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class EmployeeController extends ApiController
{
    private $employeeRepo;
    private $userRepo;
    private $imageRepo;

    public function __construct
    (
        Employee $employee,
        User $user,
        Image $image
    )
    {
        $this->employeeRepo = new BaseRepository($employee);
        $this->userRepo = new BaseRepository($user);
        $this->imageRepo = new BaseRepository($image);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = $this->userRepo->whereWith('employee', ['employee', 'images'])->get();

        return $this->showAll($employees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRegRequest $request)
    {

        $user = $this->userRepo->createUpdate($request->only($this->userRepo->getModel()->fillable));

        $image = $this->imageRepo->find($request->image_id);
        $user->images()->save($image);

        $employee = $this->employeeRepo->createUpdate($request->only($this->employeeRepo->getModel()->fillable));
        $user->employee()->save($employee);

        if($request->has('material')) {
            return $employee;
        }

        return $this->showOne($employee, 201);
//        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = $this->employeeRepo->find($id);

        return $this->showOne($employee);
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
        $employee = $this->employeeRepo->delete($id);

        return $this->showOne($employee);
    }
}
