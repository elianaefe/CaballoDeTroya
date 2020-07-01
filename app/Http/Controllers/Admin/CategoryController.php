<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;
use File;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->paginate(5);
        return view('admin.categories.index')->with(compact('categories'));  //listado
    }

    public function create()
    {
        return view('admin.categories.create');   //formulario
    }

    public function store(Request $request)
    {
        //validacion

        $messages = [
            'name.required' => 'Es necesario ingresar un nombre para la categoría.',
            'name.min' => 'El nombre de la categoría debe tener al menos 3 caracteres.',
            'description.max' => 'La descripción solo admite hasta 350 caracteres.'
        ];

        $rules = [
            'name' => 'required|min:3',
            'description' => 'max:350'
        ];

        $this->validate($request, $rules, $messages);

        //return view('');  registrar la categoría en la BD
        $category = Category::create($request->only('name', 'description')); //mass assignment-> asignación masiva
        //se encarga de hacer un INSERT en la tabla

        if ($request->hasFile('image')) {
        //guardar imagen en nuetro proyecto
            $file = $request->file('image');
            $path = public_path() . '/images/categories';
            $fileName = uniqid() . $file->getClientOriginalName();
            $moved = $file->move($path,$fileName); 

        //update category
            if ($moved) {
                $category->image = $fileName;
                $category->save(); //UPDATE
            }
        }
        return redirect('admin/categories');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit')->with(compact('category'));   //formulario para editar, a traves del id le paso los datos de la categoria a editar
    }

    public function update(Request $request, Category $category)
    {
        //validacion

        $messages = [
            'name.required' => 'Es necesario ingresar un nombre para el producto.',
            'name.min' => 'El nombre del producto debe tener al menos 3 caracteres.',
            'description.max' => 'La descripción solo admite hasta 350 caracteres.'
        ];

        $rules = [
            'name' => 'required|min:3',
            'description' => 'max:350'
        ];
        
        $this->validate($request, $rules, $messages);

        //return view('');  registrar el producto en la BD
        $category->update($request->only('name', 'description')); //se encarga de hacer un UPDATE en la tabla

        if ($request->hasFile('image')) {
        //guardar imagen en nuetro proyecto
            $file = $request->file('image');
            $path = public_path() . '/images/categories';
            $fileName = uniqid() . $file->getClientOriginalName();
            $moved = $file->move($path,$fileName); 

        //update category
            if ($moved) {
                $previousPath = $path . '/' . $category->image;

                $category->image = $fileName;
                $saved = $category->save(); //UPDATE

                if ($saved)
                    File::delete($previousPath);

            }
        }

        return redirect('admin/categories');
    }

     public function destroy($id)
    {
        //return view('');  registrar el producto en la BD
        $category = Category::find($id);
        $category->delete(); //se encarga de hacer un DELETE en la tabla

        return back();
    }
}
