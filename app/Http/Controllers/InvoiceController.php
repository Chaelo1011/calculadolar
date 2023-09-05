<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Product;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index ()
    {
        //Codigo de la factura
        //Fecha de la factura
        //Cantidad de productos de la factura
        //Total de venta en $
        //Total de ventas en Bs
        
        $invoices = DB::table('products')
                        ->join('sale_details', 'products.id', '=', 'sale_details.product_id')
                        ->join('invoice', 'sale_details.invoice_id', '=', 'invoice.id')
                        ->select('invoice.id', 'invoice.created_at', DB::raw('SUM(sale_details.quantity) as total_quantity'), DB::raw('SUM(products.dollar_sale_price*sale_details.quantity) as total_price'))
                        ->groupBy('invoice.id')
                        ->get();

        return view('invoice.index', [
            'invoices' => $invoices
        ]);
    }
}
