<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositoriesInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepo = null;

    // Contract Function
    public function __construct(UserRepositoriesInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    //
    public function user(Request $request) {
        return $request->user();
    }

    // Show All Users
    public function index () {
        return $this->userRepo->getAllUsers();
    }

    // Find User
    public function show($id) {
        return $this->userRepo->getUsersById($id);
    }

    // Create User
    public function store(Request $request) {

        $data = $request->only($this->userRepo->getUserModel()->fillabl);

//        $user =  $this->userRepo->CreateUpdateUser($data);

        return $request->all();
    }

    // Update User
    public function update(Request $data, $id) {
        $user = $this->userRepo->CreateUpdateUser($data, $id);

        return $data->firstName;
    }

    // Delete User
    public function destroy($id) {
        $this->userRepo->DeleteUser($id);

        return 'user deleted';
    }

}
