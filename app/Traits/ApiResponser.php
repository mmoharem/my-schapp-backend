<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait ApiResponser
{
    private function successResponse($data, $code) {
        return response()->json(['data' => $data], $code);
    }

    protected  function  errorResponse($message, $code) {
        return response()->Json(['error' => $message, 'code' => $code], $code);
    }

    protected function showAll(Collection $collection, $code = 200) {
//        $collection = $this->sortData($collection);
        return $this->successResponse($collection, $code);
//        return $this->successResponse(['data' => $collection], $code);
    }

    protected function showOne(Model $model, $code = 200) {
        return $this->successResponse(['data' => $model], $code);
    }

    protected function sortData(Collection $collection) {
        if(request()->hast('sort_by')) {
            $attribute = request()->sort_by;
            $collection = $collection->sortBy($attribute);
//            $collection = $collection->sortBy->srtBy->{$attribute};
        }
        return $collection;
    }
}