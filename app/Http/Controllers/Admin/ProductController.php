<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\Category;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.products.index')->with(compact('products'));  //listado
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create')->with(compact('categories'));   //formulario
    }

    public function store(Request $request)
    {
        //validacion

        $messages=[
            'name.required' => 'Es necesario ingresar un nombre para el producto.',
            'name.min' => 'El nombre del producto debe tener al menos 3 caracteres.',
            'description.required' => 'La descripción corta es obligatoria.',
            'description.max' => 'La descripción corta solo admite hasta 200 caracteres.',
            'price.required' => 'Es obligatorio definir un precio para el producto.',
            'price.numeric' => 'Igrese un precio válido.',
            'price.min' => 'No se admiten valores negativos.'
        ];

        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0'
        ];

        $this->validate($request, $rules, $messages);

        //return view('');  registrar el producto en la BD
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->category_id = $request->category_id; 
        $product->save(); //se encarga de hacer un INSERT en la tabla

        return redirect('admin/products');
    }

    public function edit($id)
    {
        $categories = Category::orderBy('name')->get();
        $product = Product::find($id);
        return view('admin.products.edit')->with(compact('product', 'categories'));   //formulario para editar, a traves del id le paso los datos del producto a editar
    }

    public function update(Request $request, $id)
    {
        //validacion

        $messages=[
            'name.required' => 'Es necesario ingresar un nombre para el producto.',
            'name.min' => 'El nombre del producto debe tener al menos 3 caracteres.',
            'description.required' => 'La descripción corta es obligatoria.',
            'description.max' => 'La descripción corta solo admite hasta 200 caracteres.',
            'price.required' => 'Es obligatorio definir un precio para el producto.',
            'price.numeric' => 'Igrese un precio válido.',
            'price.min' => 'No se admiten valores negativos.'
        ];

        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0'
        ];
        
        $this->validate($request, $rules, $messages);

        //return view('');  registrar el producto en la BD
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->category_id = $request->category_id; 
        $product->save(); //se encarga de hacer un UPDATE en la tabla

        return redirect('admin/products');
    }

     public function destroy($id)
    {
        //return view('');  registrar el producto en la BD
        $product = Product::find($id);
        $product->delete(); //se encarga de hacer un DELETE en la tabla

        return back();
    }
}
