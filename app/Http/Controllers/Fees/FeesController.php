<?php

namespace App\Http\Controllers\Fees;

use App\Models\SchFees;
use App\Models\ShGrade;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class FeesController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fees = SchFees::whereHas('grade')->with('grade')->get();

        return $this->showAll($fees);
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
            'grade' => 'required',
            'old_schFees' => 'required',
            'old_booksFees' => 'required'
        ];

        $old_totFees = $request->old_schFees + $request->old_booksFees;
        $request->request->add(['old_totFees' => $old_totFees]);

        if($request->filled('schFees') && $request->filled('booksFees')) {
            $totFees = $request->schFees + $request->booksFees;
            $request->request->add(['totFees' => $totFees]);
        }

        $this->validate($request, $rules);

        $fees = SchFees::create([
            'old_schFees' => $request->old_schFees,
            'schFees' => $request->schFees,
            'old_booksFees' => $request->old_booksFees,
            'booksFees' => $request->booksFees,
            'old_totFees' => $request->old_totFees,
            'totFees' => $request->totFees
        ]);
//
        $grade = ShGrade::findOrFail($request->grade);

        $fees->grade()->associate($grade)->save();

        return $this->showOne($fees, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchFees  $schFees
     * @return \Illuminate\Http\Response
     */
    public function show(SchFees $schFees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchFees  $schFees
     * @return \Illuminate\Http\Response
     */
    public function edit(SchFees $schFees)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SchFees  $schFees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SchFees $schFees)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchFees  $schFees
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchFees $schFees)
    {
        //
    }
}
