<?php

namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id_order';

    protected $fillable = ['kode_order','no_meja','id_user','cart','subtotal','keterangan','status_order'];

    public static function getId()
    {
    	return $getId = DB::table('orders')->orderBy('id_order','DESC')->take(1)->get();
    }

    public static function time_since($timestamps)
    {
        date_default_timezone_set('Asia/Jakarta');
        $chunks = array (
            array(60 * 60 * 24 * 365, 'tahun'),
            array(60 * 60 * 24 * 30, 'bulan'),
            array(60 * 60 * 24 * 7, 'minggu'),
            array(60 * 60 * 24, 'hari'),
            array(60 * 60 , 'jam'),
            array(60, 'menit'),
        );
        $today = time();
        $since =  $today - $timestamps;

        if ($since > 604800) {
           $print = date('M jS', $timestamps);

           if ($since > 31536000) {
               $print .= ", " .date('Y', $timestamps);
           }
           return $print;
        }

        for ($i=0, $j=count($chunks); $i < $j; $i++) { 
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];

            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }

        $print = ($count == 1) ? '1 ' . $name : '$count{$name}';
        return $print. ' yang lalu';
        
    }

    public static function arrayCart(Request $req)
    {
        $orders = Order::where('id_order', $req->id_order)->get();
        $orders->transform(function($order)
        {
            $order->cart = unserialize($order->cart);
            return $order;
        });
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class);
    }

    

    
}
