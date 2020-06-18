<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
	//Carrito de compras N         1 Productos
    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}
