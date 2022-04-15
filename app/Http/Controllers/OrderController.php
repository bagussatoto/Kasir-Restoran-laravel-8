<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
use Auth;
use Alert;

class OrderController extends Controller
{
    public function data(Request $req) {
    	$data = Order::join('users','users.id','orders.id_user')
    		->where('no_meja','like',"%{$req->keyword}%")
            ->select('orders.*', 'fullname')
            ->orderBy('updated_at','desc')
            ->get();
    		return view('admin.pages.order.data', ['data'=>$data]);
    }

    public function add()
    {
    	return view('admin.pages.order.add');
    }

    public function save(Request $req)
    {

        $blt = date('ms');
        $kode_ord = 'INV'.$blt.$idBaru;

        $result = new Order;
        $result->kode_order = $kode_ord.sprintf("%03s", $req->kode_order);
        $result->no_meja = $req->no_meja;
        $result->id_user = $req->id_user;
        $result->keterangan = $req->keterangan;
        $result->status_order = $req->status_order;

        if ($result->save()) {
            alert()->success('Data Berhasil Disimpan ke Database.','Tersimpan!')->autoclose(4000);
            return redirect()->route('admin.order');
        } else {
           alert()->info('Harap Periksa lagi data Formulir anda.','Tidak Tersimpan!')->autoclose(4000);
        }
        
    }

    public function edit($id_order)
    {
        $data = Order::where('id_order',$id_order)->first();
        return view('admin.pages.order.edit',['rc'=>$data]);
    }

    public function update (Request $req)
    {
        
        $field = [
                'id_order'=>$req->id_order,
                'no_meja'=>$req->no_meja,
                'id_user'=>$req->id_user,
                'keterangan'=>$req->keterangan,
                'status_order'=>$req->status_order,
            ];

        $result = Order::where('id_order',$req->id_order)->update($field);

        if ($result) {
            alert()->success('Berhasil Mengupdate Data.', 'Terupdate!')->autoclose(4000);
            return redirect()->route('admin.order');
        } else {
            alert()->info('Harap Periksa lagi data Formulir anda.','Tidak Tersimpan!')->autoclose(4000);
        }

    }

    public function delete(Request $req)
    {
        $result = Order::find($req->id_order);
        $result->transaksi()->delete();

        if ($result->delete() ){
            alert()->success('Data Berhasil Terhapus dari Database.', 'Terhapus!')->autoclose(3000);
            return redirect()->route('admin.order');
        }
        
    }

    public function entri(Request $req)
    {     
        $orders = Order::where('status_order','Pending')->orderBy('updated_at','desc')->get();
        $orders->transform(function($order) {
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('admin.pages.order.entri.entri', compact('orders'));
    }

    public function terimaEntri($id_order)
    {
        $orders = Order::where('id_order',$id_order)->first();
        $orders->update(['status_order' => 'Beres']);
        alert()->success('Pesanan Berhasil Diantar!.','Berhasil!')->persistent('oke');
        return redirect()->route('entri.order');
    }


}
