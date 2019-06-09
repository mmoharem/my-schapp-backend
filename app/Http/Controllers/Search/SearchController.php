<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\ApiController;
use App\Traits\ApiSearch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends ApiController
{
    public function filterStudents(Request $request)
    {
        $users = ApiSearch::applyStudent($request);

        return $this->showAll($users);
    }

    public function filterEmployee(Request $request)
    {
        $employees = ApiSearch::applyEmployee($request);

        return $this->showAll($employees);
    }
}
