<?php

namespace App;

use App\Masakan;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
    	if ($oldCart) {
    		$this->items = $oldCart->items;
    		$this->totalQty = $oldCart->totalQty;
    		$this->totalPrice = $oldCart->totalPrice;
    	}
    }

    public function add($item, $id)
    {
    	$storedItem = ['qty' => 0, 'harga' => $item->harga, 'item' => $item];
    	if ($this->items) {
    		if (array_key_exists($id, $this->items)) {
    			$storedItem = $this->items[$id];
    		}
    	}
    	$storedItem['qty']++;
    	$storedItem['harga'] = $item->harga * $storedItem['qty'];
    	$this->items[$id] = $storedItem;
    	$this->totalQty++;
    	$this->totalPrice += $item->harga;
    }

    public function reduceByOne($id)
    {
        $this->items[$id]['qty']--;
        $this->items[$id]['harga'] -= $this->items[$id]['item']['harga'];
        $this->totalQty--;
        $this->totalPrice -= $this->items[$id]['item']['harga'];

        if ($this->items[$id]['qty'] <= 0) {
            unset($this->items[$id]);
        }
    }

    public function addOne($id)
    {
        $this->items[$id]['qty']++;
        $this->items[$id]['harga'] += $this->items[$id]['item']['harga'];
        $this->totalQty++;
        $this->totalPrice += $this->items[$id]['item']['harga'];
    }

    public function removeItem($id)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['harga'];
        unset($this->items[$id]);
    }
}
