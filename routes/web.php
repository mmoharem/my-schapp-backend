<?php

use App\User;
use App\Models\Student;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/h', function () {
    return view('welcome');
});

Route::get('/creat', function() {
//    $user = User::findeOrFail(1);
//
//    $student = new Student([
//        'class' => '7b',
//        'grade' => 'prim1'
//    ]);
    return view('welcome');
//    $user->student()->save($student);
//    return $user;
//    return 'user created successfully';
});
