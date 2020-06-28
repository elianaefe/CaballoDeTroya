<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function details()
    {
    	return $this->hasMany(CartDetail::class);
    }

    prublic function getTotalAttribute()
    {
    	$total = 0;
    	foreach ($this->details as $detail) {
    		$total += $detail->quatity * $detail->product->price;
    	}

    	return $total;
    }
}
