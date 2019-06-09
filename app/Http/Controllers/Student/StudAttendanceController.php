<?php

namespace App\Http\Controllers\Student;

use App\Models\StudAttendance;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class StudAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'day' => 'Required',
            'attend' => 'required',
            'id'     => 'required'
        ];

        $this->validate($request, $rules);

        $student = Student::findOrFail($request->id);
//        $time = Carbon::now('GMT+2')->format('H:i:s');
        $day = Carbon::now('GMT+2')->format('Y-m-d');

        $attend1 = DB::table('stud_attendances')
//            ->where('day', $day)
            ->where('day', $request->day)
            ->get();

        if($attend1->contains('student_id', $request->id)) {
            return 'student attendance already exist';
        }else {
//            $student->checkIn($request->attend);
            $student->attend2($request->attend, $request->day);
        }


        return $student->attendances;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);

        return $student->attendances;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
