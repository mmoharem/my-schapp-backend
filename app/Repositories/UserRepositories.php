<?php

namespace App\Repositories;


use App\User;
use Illuminate\Support\Facades\Hash;

class UserRepositories implements UserRepositoriesInterface {

    private $users;

    public function __construct(User $users)
    {
        $this->users = $users;
    }

    // Get All Users
    public function getAllUsers()
    {
        return $this->users->all();
    }

    // Find User By ID.
    public function getUsersById($id)
    {
        return $this->users->findOrFail($id);
    }

    // Create Or Update User
    public function CreateUpdateUser($data, $id = null)
    {
        if(is_null($id)) { //Create User

            $user = new User;

            $user->firstName = $data->firstName;
            $user->lastName = $data->lastName;
            $user->address = $data->address;
            $user->gender = $data->gender;
            $user->birthDate = $data->birthDate;
            $user->email = $data->email;
            $user->phoneNumber = $data->phoneNumber;
            $user->mobilePhone = $data->mobilePhone;
            $user->medicalState = $data->medicalState;
            $user->notes = $data->notes;
            $user->password = Hash::make($data->password);

            return $user->save();

        } else { // Update User

            $user = $this->users->findOrFail($id);

            return $user->update($data->all());
        }
    }

    public function DeleteUser($id)
    {
        $this->users->destroy($id);
    }

    public function getUserModel() {
        return $this->users;
    }
}