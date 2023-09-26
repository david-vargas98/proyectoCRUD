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
        $inventarios = Inventario::all(); //Se obtiene los inventarios en la variable
        //Retorna la vista a esa ruta en inventario-index.blade.php
        return view('inventario-index', compact('inventarios')); //Se usa compact para usar la variable en el html xdd *investigar*
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
        //
        return view('inventario-show'); //Para acceder a los inventarios se hace por ID, así: proyectocrud.test/inventario/1
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
