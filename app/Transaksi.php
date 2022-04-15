<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transactions';
    protected $guarded = ['id','created_at','updated_at'];

    public function order()
	{
		return $this->belongsTo(Order::class);
	}
}

