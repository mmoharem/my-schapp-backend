<?php

namespace App\Repositories;

interface BaseRepositoryInterface {

    public function getAll();

    public function find($id);

    public function createUpdate(array $data, $id = null);

    public function delete($id);

}