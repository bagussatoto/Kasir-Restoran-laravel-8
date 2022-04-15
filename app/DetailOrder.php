<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    protected $table = 'masakan_order';
    protected $fillable = [
        'order_id_order',
        'masakan_id',
        'qty',
        'subtotal',
        'keterangan_detail',
        'status_detail_order'
    ];

}
