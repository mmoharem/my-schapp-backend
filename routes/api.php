<?php
use App\User;
use App\Models\Student;
use App\Models\ShGrade;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/', 'UserController@index');
//Route::get('/user', 'UserController@user')->middleware('auth:api');
//Route::post('/login', 'AuthController@login');
Route::resource('/user', 'UserController');
Route::resource('/test/user', 'TestUserController');

//Route::get('/students', 'StudentController@index');
//Route::post('/student/creat', 'StudentController@store');
Route::post('/upload/img', 'Images\ImageController@store');
Route::post('/signup', 'StudentController@store');

//student
Route::resource('/students', 'Student\StudentController', ['only' => ['index', 'store', 'update', 'destroy']]);
//Route::post('/students/img/{id}', 'Student\StudentController@update');
Route::post('/students/attend', 'Student\StudAttendanceController@store');
Route::resource('/students/transactions', 'Transactions\TransactionsController', ['only' => ['index', 'store', 'show']]);
//Route::resource('/students/payments', 'Payments\StudPayments', ['only' => ['index', 'store']]);
Route::get('/calc/{id}', 'Payments\StudPayments@calcPayments');

//School
Route::resource('/school/grade', 'Grade\GradeController', ['only' => ['index', 'store', 'show']]);
Route::resource('/school/fees', 'Fees\FeesController', ['only' => ['index', 'store']]);
//Route::resource('/search', 'Search\OldSearchController', ['only' => ['filter']]);
//Route::get('/search', 'OldSearchController@index');
Route::post('/search', 'OldSearchController@filter');
Route::post('/students/search', 'OldSearchController@filterStudents');

//Pdf
Route::get('/pdf', 'other\PrintController@pdf');



Route::get('/creat/{id}', function($id) {
    $user = User::findOrFail($id);
//
    $student = new Student([
//        'grade' => 'kg-2',
        'class' => 'kg-2c',
    ]);
    $user->student()->save($student);
    return $user->student;
//    return 'user created successfully';
});

Route::get('/getxx', function(Student $students) {

    $student = $students->findOrFail(1);

    $grade = ShGrade::findOrFail(3);

//    $student->grade->save();
//    $grade->students()->save($student);
    $student->grade()->associate($grade)->save();
    return $grade;
});

Route::get('/image', function(Request $request) {



    return $request;
});
