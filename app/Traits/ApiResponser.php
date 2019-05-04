<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

trait ApiResponser
{
    private function successResponse($data, $code) {
        return response()->json(['data' => $data], $code);
    }

    protected  function  errorResponse($message, $code) {
        return response()->Json(['error' => $message, 'code' => $code], $code);
    }

    protected function showAll(Collection $collection, $code = 200) {
        $collection = $this->paginate($collection);
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

    protected function paginate(Collection $collection) {

        $rules = ['per_page' => 'integer|min:2|max:50'];

        Validator::validate(request()->all(), $rules);

        $page = LengthAwarePaginator::resolveCurrentPage();

        $perPage = 4;

        If(request()->has('per_page')) {
            $perPage = (int) request()->per_page;
        }

        $results = $collection->slice(($page - 1) * $perPage, $perPage)
            ->values();
        ;

        $paginated = new LengthAwarePaginator(
            $results, $collection->count(), $perPage, $page, [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
            ]
        );

        $paginated->appends(request() -> all);

        return $paginated;
    }
}