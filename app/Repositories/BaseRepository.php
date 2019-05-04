<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class BaseRepository implements BaseRepositoryInterface {

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Show All Records
    public function getAll()
    {
        return $this->model->all();
    }

    // Find Record By ID.
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    // Create Update Record
    public function createUpdate(array $data, $id = null)
    {
        // Encrypt Password
        if(Arr::has($data, 'password')) {
            $data['password'] = Hash::make($data['password']);
        }
//
        // Create Or Update Record
        if(is_null($id)) { // Create Record

            return $this->model->create($data);

        } else { // Update Record

            $record = $this->model->findOrFail($id);

            return $record->update($id);

        }
    }

    // Delete Record
    public function delete($id)
    {
        $user = $this->model->findOrFail($id);

        $user->destroy($id);

        return $user;
    }

    // Return The Model
    public function getModel()
    {
        return $this->model;
    }

    // Set Model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    // Eager Load DB Relation
    public function with($relations)
    {
        return $this->model->with($relations);
    }

    // Eager Load DB Relation
    public function __call($method, $args)
    {
        return call_model_func_array([$this->model, $method], $args);
    }

}