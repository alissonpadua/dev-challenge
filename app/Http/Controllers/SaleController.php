<?php

namespace DevChallenge\Http\Controllers;

use Illuminate\Http\Request;
use DevChallenge\Http\Controllers\ApiBaseController;
use DevChallenge\Http\Requests\SaleRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DevChallenge\Models\Product;
use DevChallenge\Models\Client;
use DevChallenge\Models\Paymode;
use DevChallenge\Models\Sale;
use DevChallenge\Models\ProductSale;

class SaleController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::with(['paymode', 'client'])->get();

        foreach($sales as $sale) {
            $sale['totalSale'] = $this->getSaleTotal($sale->id);
        }

        return $this->sendResponse($sales->toArray(), '');
    }

    private function getSaleTotal($id)
    {
        $sale = Sale::find($id);
        $totalSale = 0;
        foreach($sale->salesLine as $lineTotal){
            $totalSale += $lineTotal->qty * $lineTotal->price;
        }

        return 'R$ ' . number_format($totalSale, 2, ',', '.');
    }

    public function getProductsBySale($id) {
        $sale = Sale::find($id);
        if(!$sale) {
            return $this->sendError('Venda não foi encontrada'); 
        }
        return $this->sendResponse($sale->products(), '');
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
    public function store(SaleRequest $request)
    {
        try{
            DB::beginTransaction();

            $client = Client::find($request->client);
            if(!$client) {
                DB::rollBack();
                return $this->sendError('Cliente não foi encontrado em nossa base de dados'); 
            }

            $paymode = Paymode::find($request->paymode);
            if(!$paymode) {
                DB::rollBack();
                return $this->sendError('Método de Pagamento não foi encontrado em nossa base de dados'); 
            }

            foreach($request->products as $product) {
                if(!Product::find($product['id'])) {
                    DB::rollBack();
                    return $this->sendError($product['description'] . ' não foi encontrado em nossa base de dados'); 
                }
            }

            $sale = Sale::create([
                'user_id' => Auth::user()->id,
                'client_id' => $client->id,
                'paymode_id' => $paymode->id
            ]);

            foreach($request->products as $product) {
                ProductSale::create([
                    'product_id' => $product['id'],
                    'sale_id' => $sale->id,
                    'price' => $product['price'],
                    'qty' => $product['qty']
                ]);
            }

            DB::commit();

            return $this->sendResponse($sale->toArray(), 'Venda realizada sucesso');

        }catch(Exception $e){
            DB::rollBack();
            return $this->sendError('Erro de sistema ao efetuar venda, contate o administrador');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
