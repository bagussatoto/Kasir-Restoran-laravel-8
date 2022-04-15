<?php

namespace App\Exports;
use App\Transaksi;
use App\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OwnerExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $data = Transaksi::join('orders','orders.id_order','transactions.order_id_order')
        	->join('users','users.id','transactions.user_id')
        	->select('transactions.*','users.fullname','orders.*')
        	->get();
        $pendapatan = Order::where('status_order','Beres')->sum('subtotal');
        return view('admin.pages.report.excel',compact('data'),compact('pendapatan'));
    }
}
