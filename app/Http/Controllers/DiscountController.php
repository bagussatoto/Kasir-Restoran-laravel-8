<?php

namespace App\Http\Controllers;

use App\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{

    public function daftar(Request $req)
    {
        $discount = Discount::all();
        return view('admin.pages.discount.daftar', compact('discount'));
    }

    public function save(Request $req)
    {
        $kode_voucher = str_random(7);

        $discount = new Discount;
        $discount->kode_discount = $kode_voucher;
        $discount->percent_off = $req->percent_off;
        
        if ($discount->save()) {
            alert()->success('Data Berhasil Ditambahkan.','Tersimpan!')->autoclose(3500);
            return redirect()->route('daftar.discounts');
        } else {
            alert()->warning('Harap Periksa Kembali.','gagal!')->autoclose(3500);
        }
        

    }

    public function edit($id)
    {
        $discount = Discount::where('id', $id)->first();
        return view('admin.pages.discount.edit', compact('discount'));
    }

    public function update(Request $req)
    {
        \Validator::make($req->all(), [
            'percent_off' => 'required|between:1,100|unique:discounts,percent_off,'.$req->id,
        ])->validate();
        $discount = Discount::where('id',$req->id)->update(['percent_off' => $req->percent_off]);
        
        if ($discount) {
            alert()->success('Berhasil Mengupdate Data.','Terupdate!')->autoclose(3500);
            return redirect()->route('daftar.discounts');
        } else {
            return back()->with('result','fail');
        }
        
    }

    public function destroy(Request $req)
    {
        $discount = Discount::find($req->id);
        if($discount->delete()) {
            alert()->success('Data Berhasil Terhapus dari Database.', 'Terhapus!')->autoclose(3000);
            return redirect()->route('daftar.discounts');
        }
    }
}
