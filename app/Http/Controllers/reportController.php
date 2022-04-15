<?php

namespace App\Http\Controllers;

use Auth;
Use App\Order;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OwnerExport;

class reportController extends Controller
{
    public function excel()
    {
        return Excel::download(new OwnerExport,'data_transaksi.xlsx');
    }
    public function pdf()
    {
        $data = DB::table('transactions')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->join('orders', 'transactions.order_id_order', '=', 'orders.id_order')
            ->select('transactions.*', 'users.fullname', 'orders.*')
            ->get();
        $pendapatan = Order::where('status_order','Beres')->sum('subtotal');
    
        $pdf = PDF::loadView('admin.pages.report.pdf', compact('data'), compact('pendapatan'));
        return $pdf->download('data_transaksi.pdf');    
    }
    public function invoice(Request $req)
    {
    	$data = DB::table('transactions')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->join('orders', 'transactions.order_id_order', '=', 'orders.id_order')
            ->select('transactions.*', 'users.fullname', 'orders.*')
            ->where('orders.kode_order', $req->kode_order)
            ->get();

        $orders = Order::where('kode_order',$req->kode_order)->get();
        $orders->transform(function($order) {
            $order->cart = unserialize($order->cart);
            return $order;
        });
    	return view('admin.pages.report.invoice', compact('data'), compact('orders'));
    }

    public function delivery(Request $req)
    {
        $orders = Order::where('id_user',Auth::id())
                ->orderBy('updated_at','desc')->take(1)->get();
        $orders->transform(function($order) {
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('admin.pages.report.delivery', compact('orders'));
    }

    public function buat(Request $req)
    {
        $data = DB::table('transactions')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->join('orders', 'transactions.order_id_order', '=', 'orders.id_order')
            ->select('transactions.*', 'users.fullname', 'orders.*')
            ->orderBy('transactions.updated_at','desc')
            ->get();

        $pendapatan = DB::table('orders')->sum('subtotal');

        return view('admin.pages.report.buat', compact('data'), compact('pendapatan'));
    }


}
