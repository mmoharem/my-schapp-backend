<?php

namespace App\Http\Controllers\Searsch;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;

class SearchController extends ApiController
{
    public function filterStudents(Request $request) {

        $users = ApiSearch::applyStudent($request);

        return $this->showAll($users);
    }
}
