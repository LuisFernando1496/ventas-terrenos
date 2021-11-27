<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abonos = Sale::where('payment_type','=',2)->with(['abonos','client'])->paginate(10);

        return view('payments.index',[
            'abonos' => $abonos
        ]);
        return $abonos;
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
        //return $request;
        try {
            DB::beginTransaction();
            $restante = $request->adeudo - $request->pay;
            $pay = new Payment();
            $pay->sale_id = $request->sale_id;
            $pay->pay = $request->pay;
            $pay->faltante = $restante;
            $pay->save();
            if($restante <= 0)
            {
                DB::table('sales')->where('id',$request->sale_id)->update([
                    'status_credit' => "Pagado"
                ]);
            }
            else
            {
                DB::table('sales')->where('id',$request->sale_id)->update([
                    'status_credit' => "Adeudo"
                ]);
            }
            DB::commit();
            return redirect()->route('payment.index');
        } catch (\Error $th) {
            DB::rollBack();
            return $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payament  $payament
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $pago)
    {
        //return $pago;
        $pagos = Payment::where('sale_id','=',$pago->sale_id)->get();
        $abonos = 0;
        foreach ($pagos as $pago) {
            $abonos += $pago->pay;
        }
        return view('payments.ticket',[
            'pay' => $pago,
            'abonos' => $abonos
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payament  $payament
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payament)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payament  $payament
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payament)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payament  $payament
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payament)
    {
        //
    }
}
