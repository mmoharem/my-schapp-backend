<?php

namespace App\Traits;

use App\User;
use Illuminate\Http\Request;

class ApiSearch
{
    public static function apply(Request $filters) {
        $user = (new User)->newQuery();

        if($filters->filled('lastName')) {
            $user->where('lastName', $filters->lastName);
        }

        if($filters->filled('firstName')) {
            $user->where('firstName', $filters->firstName);
        }


        return $user->get();
    }
}