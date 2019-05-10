<?php

namespace DevChallenge\Http\Controllers;

use Illuminate\Http\Request;
use DevChallenge\Http\Controllers\ApiBaseController;
use DevChallenge\Models\Sale;
use DevChallenge\Models\Product;
use DevChallenge\Models\ProductSale;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends ApiBaseController
{
    public function getSalesTotal() {

        $now = Carbon::now();
        $now->year;
        $now->month;

        // Total de Vendas
        $sales = Sale::all();
        $totalSale = 0;
        foreach($sales as $sale) {
            foreach($sale->salesLine as $lineTotal){
                $totalSale += $lineTotal->qty * $lineTotal->price;
            }
        }

        // Total de Vendas no Mês
        $salesMonth = Sale::whereRaw(DB::raw("MONTH(created_at) = $now->month"))->get();
        $totalMonth = 0;
        foreach($salesMonth as $sale) {
            foreach($sale->salesLine as $lineTotal){
                $totalMonth += $lineTotal->qty * $lineTotal->price;
            }
        }

        // Total de Vendas Hoje
        $salesToday = Sale::whereRaw(DB::raw("DAY(created_at) = $now->day"))->get();
        $totalToday = 0;
        foreach($salesToday as $sale) {
            foreach($sale->salesLine as $lineTotal){
                $totalToday += $lineTotal->qty * $lineTotal->price;
            }
        }

        $response = [
            'totalSales' => $this->formatCurrency($totalSale),
            'salesMonth' => $this->formatCurrency($totalMonth),
            'salesToday' => $this->formatCurrency($totalToday)
        ];

        return $this->sendResponse($response, '');
    }

    public function getProductTotals() {

        $response = ProductSale::groupBy('product_id', 'products.description')
            ->selectRaw(DB::raw("product_id, products.description, sum(qty) as total"))
            ->join('products', 'products.id', '=', 'product_id')
            ->get();
        
        return $this->sendResponse($response, '');
    }

    private function formatCurrency($n){
        return 'R$ ' . number_format($n, 2, ',', '.');
    }
}
