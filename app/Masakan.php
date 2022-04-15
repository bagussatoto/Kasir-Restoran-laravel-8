<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Masakan extends Model
{
	//deklarasi tabel
    protected $table = 'masakan';

    protected $fillable = ['id','kategori_id','nama_masakan','harga','status_masakan'];

    public static function getId()
    {
    	return $getId = DB::table('masakan')->orderBy('id','DESC')->take(1)->get();
    }

    public function order()
    {
    	return $this->belongsToMany(Order::class)->withPivot(['subtotal']);
    }


}
