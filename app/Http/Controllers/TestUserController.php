<?php

namespace App\Http\Controllers;

use App\Repositories\BaseRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class TestUserController extends ApiController
{
    private $modelRepo;

    public function __construct(User $user)
    {
        $this->modelRepo = new BaseRepository($user);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $users = $this->modelRepo->showAll();

        $users = $this->modelRepo->getModel()->whereHas('student')->with('student.grade.fees', 'student.payment')->get();
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only($this->modelRepo->getModel()->fillable);

        $user = $this->modelRepo->createUpdate($data);

        return $this->showOne($user, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->modelRepo->showRecord($id);

        return $user;
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
        $data = $request->only($this->modelRepo->getModel()->fillable);

        $this->modelRepo->createUpdate($data, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->modelRepo->delete($id);

        return $this->showOne($user, 201);
    }

    public function getRelation()
    {
        $user = $this->modelRepo->getModel()->all();
    }
}
