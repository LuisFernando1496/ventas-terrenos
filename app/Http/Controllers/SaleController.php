<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductInSale;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{

    public function index()
    {
        $clients = Client::where('status',true)->get();
        return view('sale.index',['clients'=>$clients]);
    }

    public function create()
    {
        //
    }
    public function reprint(Request $request)
    {

        $sale = Sale::where('id', $request->sale_id)->with(['branchOffice', 'productsInSale.product'])->first();
        $client = Client::where('id', '=', $sale->client_id)->first();

            return view('sale.nota', ['sale' => $sale, 'client' => $client]);

    }
    public function store(Request $request)
    {
        //return $request['payment_type'];
       //return response()->json(['success' => true, 'data' => $request->all()]);
        $sale = $request->all()["sale"];
        $client = Client::findOrFail($sale['client_id']);
        $total_cost_sale = 0;
        // $request['branch_office_id'] = Auth::user()->branch_office_id;
        $sale['branch_office_id'] = Auth::user()->branch_office_id;
        // $request['user_id'] = Auth::user()->id;
        $sale['user_id'] = Auth::user()->id;
        $sale['client_id'] = $client->id;
        $sale['total_cost'] = 0;

        $tipo = $request['payment_type'];
        try {
            DB::beginTransaction();
            if($tipo == "2")
            {
                $sale['status_credit'] = "Adeudo";
            }
            $sale = new Sale($sale);
            $sale->save();
            if($sale->payment_type == "2")
            {
                $request['status_credit'] = "adeudo";
                $abono = new Payment();
                $abono->sale_id = $sale->id;
                $abono->pay = $request['abono'];

                $pagos = Payment::where('sale_id','=',$sale->id)->orderBy('created_at','DESC')->first();
                if($pagos != null)
                {
                    if($pagos->faltante < $request['abono'])
                    {
                        $abono->faltante = 0;
                    }
                    else
                    {
                        $abono->faltante = $pagos->faltante - $request['abono'];
                    }
                }
                else
                {
                    $abono->faltante = $sale->cart_total - $request['abono'];
                }

                $abono->save();
            }
            foreach ($request->all()["products"] as $key => $item) {
                $product = Product::findOrFail($item['id']);


                $newProductInSale = [
                    'product_id' => $item['id'],
                    'sale_id' => $sale->id,
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['subtotal'],
                    'sale_price' => $item['sale_price'],
                    'total' => $item['total'],
                    'total_cost' => $product->price * $item['quantity'],
                    'discount' => $item['discount'],
                ];

                $total_cost_sale = $total_cost_sale + $newProductInSale['total_cost'];

                $productInSale = new ProductInSale($newProductInSale);
                $productInSale->save();
            }

            DB::commit();
            return response()->json(['success' => true, 'data' => Sale::where('id', $sale->id)->first()]);
        } catch (\Error $th) {
            DB::rollBack();
            return $th;
            return response()->json(['success' => false, 'error' => $th]);
        }

    }

    public function show(Sale $sale)
    {
        //
    }


    public function historySale()
    {
        $sales = Sale::where("status",true)->get();
        return view('sale.historySale',['sales'=>$sales]);
    }


    public function update(Request $request, Sale $sale)
    {
        //
    }

    public function search(Request $request)
    {


            $datas = Product::join('projects','products.project_id','projects.id')
            ->join('business_units','projects.business_unit_id','business_units.id')
            ->where("products.status", "=", true)
            ->orWhere("products.colonia", "LIKE", "%{$request->search}%")
            ->orWhere("business_units.name", "LIKE", "%{$request->search}%")
            ->orWhere("projects.name", "LIKE", "%{$request->search}%")
            ->select('products.*', 'products.bar_code as codigo',
                    'products.colonia as colonia',
                    'products.numero_terreno as terreno',
                    'products.lote as lote',
                    'products.manzana as manzana',
                    'products.dimenciones as dimenciones',
                    'products.price as precio',
                    'projects.name as proyecto',
                    'business_units.name as unidad'
            )
           ->get();

        return response()->json($datas);
    }

    public function searchByCode(Request $request)
    {
        $datas = Product::join('projects','products.project_id','projects.id')
                 ->join('business_units','projects.business_unit_id','business_units.id')
                 ->where("products.status", "=", true)
                 ->where('products.bar_code',$request->search)
                 ->select('products.*', 'products.bar_code as codigo',
                          'products.colonia as colonia',
                          'products.numero_terreno as terreno',
                          'products.lote as lote',
                          'products.manzana as manzana',
                          'products.dimenciones as dimenciones',
                          'products.price as precio',
                          'projects.name as proyecto',
                          'business_units.name as unidad'
                          )
                 ->get();

        return response()->json($datas);
    }



    public function destroy(Sale $sale)
    {
        //
    }
}
