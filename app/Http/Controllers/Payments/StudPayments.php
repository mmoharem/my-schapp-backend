<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\ApiController;
use App\Models\SchFees;
use App\Models\ShGrade;
use App\Models\Student;
use App\Models\StudPayment;
use App\Models\StudTransaction;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudPayments extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments =  StudPayment::all();

        return $this->showAll($payments);
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

        $payment = new StudPayment([
            'type' => $request->type,
            'amount' => $request->amount
        ]);

        $student->payments()->save($payment);

        return $this->showOne($payment, 201);

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

        $payments = $student->payments;

        return $this->showAll($payments);
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

    public function calcPayments2() {

        $users = User::all();

        $students = collect();

        foreach ($users as $user) {

//          $students->add($user->student()->with('user', 'grade', 'grade.fees', 'transactions')->get());

//            $fees = $students->add($user->student()->whereHas('grade.fees')->with('grade.fees')->get());


            $fees = $user->student()->whereHas('grade.fees')->with('grade.fees')->get()->pluck('grade.fees');
//            $totalFees = $fees[0]['schFees'];
        }


//        $students = collect($students)->collapse();
//        return $totalFees;
            return $fees[0]['schFees'];

    }

    public function calcPayments3() {
        $user = User::find(14);
        $transactions = $user->student()->with('transactions')->get()->pluck('transactions')->collapse();
        $fees = $user->student()->with('grade.fees')->get()->pluck('grade.fees');
        $totalFees = $fees[0]['schFees']+$fees[0]['booksFees'];
        $gr = ShGrade::find(9);
        $gr->fees;

//        return $totalFees;
        return $transactions;
    }

    public function calcPayments($id) {

        $total_payments = 0;
        $tot_paid_fees = 0;

        $student = Student::findOrFail($id);

        $tranactions = $student->transactions;

        foreach ($tranactions as $transaction) {

            $total_payments += $transaction->amount;

            if($transaction->type == 'school_fees') {
                $tot_paid_fees += $transaction->amount;
            } else {
                $tot_paid_fees = 0;
            }
        }

        $fees = $student->grade->fees;

        if($fees->schFees) {
//            $tot_sch_fees = totFees;

            $to_paid = $fees->totFees - $tot_paid_fees;

        }
        else {
            $to_paid = null;
        }

        $payment = StudPayment::create([
            'total_payments' => $total_payments,
            'tot_paid_fees'  => $tot_paid_fees,
            'to_pay_fees'    => $to_paid
        ]);

//        $payment = [
//            'total_payments' => $total_payments,
//            'tot_paid_fees'  => $tot_paid_fees,
//            'to_pay_fees'    => $to_paid
//        ];


        $student->payment()->save($payment);

//        return $tot_paid_fees;
//        return $tranactions ;
//        return $total_payments;
        return $payment;
    }

}
