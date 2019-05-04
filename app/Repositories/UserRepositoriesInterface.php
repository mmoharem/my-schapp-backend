<?php

namespace App\Repositories;


interface UserRepositoriesInterface {
    public function getAllUsers();

    public function getUsersById($id);

    public function CreateUpdateUser($data, $id = null);

    public function DeleteUser($id);

    public function getUserModel();
}