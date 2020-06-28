<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
	/*public static $messages=[
            'name.required' => 'Es necesario ingresar un nombre para el producto.',
            'name.min' => 'El nombre del producto debe tener al menos 3 caracteres.',
            'description.max' => 'La descripción solo admite hasta 350 caracteres.'
    ];

    public static $rules = [
        'name' => 'required|min:3',
        'description' => 'max:350'
    ];*/


	protected $fillable = ['name', 'description'];

    public function products()
    {
         return $this->hasMany(Product::class);
    }

    public function getFeaturedImageUrlAttribute()
    {
        $featuredProduct = $this->products()->first();
        return $featuredProduct->featured_image_url;
    }
}
 