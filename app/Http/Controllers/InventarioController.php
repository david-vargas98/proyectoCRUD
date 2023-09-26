<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Se regresa todo, se puede usar get() en su lugar, hace casi lo mismo
        $inventarios = Inventario::all(); //Esta línea la coleeción de los registros de la tabla en la variable
        //Retorna la vista a esa ruta en inventario-index.blade.php
        return view('inventario-index', compact('inventarios')); //Se usa compact para pasar la variable a esa vista: Esto significa que la vista tendrá acceso a la variable $inventarios y podrá mostrar la lista de inventarios.
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Retorna la vista a esa ruta en inventario-index.blade.php
        return view('inventario-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validación para los valores de entrada (investigar)
        $request->validate([
            //Esta validación asegura que no se repitan valores, que sea 255 caracteres max, y que sea string solamente y ER
            'descripcion' => ['required','unique:inventarios','min:3','max:255','string','regex:/^[A-Za-z0-9\s\-]+$/']
        ]);

        //Almacenamiento del registro
        $inventario = new Inventario(); //Instancia del modelo Inventario
        $inventario->descripcion = $request->descripcioninv;
        $inventario->save();
        //Se redirige a la url última petición
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventario $inventario)
    {
        //Para acceder a los inventarios se hace por ID, así: proyectocrud.test/inventario/1
        //Se devuelve la vista inventario-show y se pasa la variable $inventario a esa vista utilizando la función compact. Esto significa que la vista tendrá acceso al objeto de inventario específico.
        return view('inventario-show', compact('inventario')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventario $inventario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventario $inventario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventario $inventario)
    {
        //
    }
}
