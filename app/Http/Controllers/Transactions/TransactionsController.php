<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\ApiController;
use App\Models\Student;
use App\Models\StudTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class transactionsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions =  StudTransaction::all();

        return $this->showAll($transactions);
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
            'type' => 'required',
            'amount' => 'required',
            'student_id' => 'required'
        ];

        $this->validate($request, $rules);

        $student = Student::findOrFail($request->student_id);

        $transaction = new StudTransaction([
            'type' => $request->type,
            'amount' => $request->amount
        ]);

        $student->transactions()->save($transaction);

        return $this->showOne($transaction, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudTransaction  $studTransaction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);

        $transactions = $student->transactions;

        return $this->showAll($transactions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudTransaction  $studTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(StudTransaction $studTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudTransaction  $studTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudTransaction $studTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudTransaction  $studTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudTransaction $studTransaction)
    {
        //
    }
}
