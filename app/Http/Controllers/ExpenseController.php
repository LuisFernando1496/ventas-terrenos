<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagos = Expense::where('status',1)->get();
        return view('expense.index',['pagos'=>$pagos]);
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
        try {
            DB::beginTransaction();
            $expense = Expense::create($request->all());
            DB::commit();
            return redirect()->route('pagos');
        } catch (\Error $th) {
            DB::rollBack();
            return $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        try {
            DB::beginTransaction();
            $expense->update($request->all());
            DB::commit();
            return redirect()->route('pagos')->with('mensaje',"El pago $request->name_expenditure se a actualizado");
        } catch (\Error $th) {
            DB::rollBack();
            return $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function supr(Expense $expense){
        try {
            BD::beginTransaction();
            $expense->update(
                [ 
                    'status'=> false
                ]
             );
            BD::commit();
            return redirect()->route('pagos')->with('mensaje',"El pago se a Eliminado");
        } catch (\Error $th) {
            DB::rollBack();
            return $th;
        }
    }

    public function destroy(Expense $expense)
    {
        //
    }
}
