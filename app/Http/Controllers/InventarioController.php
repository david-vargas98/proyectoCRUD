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
        //Retorna la vista a esa ruta en inventario-index.blade.php
        return view('inventario-index');
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
        //Validación
        $request->validate([

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
