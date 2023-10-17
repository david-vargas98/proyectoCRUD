<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use App\Models\Inventario; //Se agrega el modelo de Inventario
use Illuminate\Http\Request;

class InsumoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Se crea una variable que alamcenará la colección de registros de la tabla Inventarios
        $inventarios = Inventario::all();
        //Se retorna la vista y se pasa la variable que contiene la colección de registros
        return view('insumos.add-insumo', compact('inventarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Hay dos formas de guardar una relación:
        //La primera:
        $insumo = new Insumo(); //Se crea instancia del modelo Insumo
        $insumo->insumodescripcion = $request->insumodescripcion; //Se asignan los atributos
        $insumo->insumocantidad = $request->insumocantidad;
        $insumo->id_inventario = $request->id_inventario;
        $insumo->save(); //Se guarda el registro en la base de datos

        //La segunda:
        //$insumo = new Insumo(); //Se crea instancia del modelo Insumo
        //$insumo->insumodescripcion = $request->insumodescripcion; //Se asignan los atributos
        //$insumo->insumocantidad = $request->insumocantidad;
        //Aquí, se obtiene una instancia del modelo Inventario
        //$inventario = Inventario::find($request->id_inventario);
        //$inventario->insumos()->save($insumo); //Se usa la relación 1:m "insumos" para asociar el insumo y se guarda

        //Se redirige después de almacenar el insumo
        return redirect()->route('inventario.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Insumo $insumo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Insumo $insumo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Insumo $insumo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Insumo $insumo)
    {
        //
    }
}
