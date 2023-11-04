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

     //3er método: declarando un constructor dentro del controlador
     //Esta opción aplica el middleware de autenticación a todos los métodos del controlador, excepto los métodos index y show:
     //public function __construct()
     //{
     //   $this->middleware("auth")->except('index', 'show');
     //}
     //Esto significa que para acceder a cualquier acción excepto index y show, el usuario debe estar autenticado. Si un usuario no autenticado intenta acceder, será redirigido al inicio de sesión.
    public function index()
    {
        //Se implementa el index para los insumos
        $insumos = Insumo::first()->paginate(4); //Se obtiene la colección de los insumos
        return view('insumos.index-insumo', compact('insumos')); //Se retorna la vista y se pasa la variable con los insumos
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
        //$insumo = new Insumo(); //Se crea instancia del modelo Insumo
        //$insumo->insumodescripcion = $request->insumodescripcion; //Se asignan los atributos
        //$insumo->insumocantidad = $request->insumocantidad;
        //$insumo->inventario_id = $request->id_inventario;
        //$insumo->save(); //Se guarda el registro en la base de datos

        //La segunda (La que debe seguir el estándar de "_id" para no especificar el nombre de la columna en el modelo):
        $insumo = new Insumo(); //Se crea instancia del modelo Insumo
        $insumo->insumodescripcion = $request->insumodescripcion; //Se asignan los atributos
        $insumo->insumocantidad = $request->insumocantidad;
        //Aquí, se obtiene una instancia del modelo Inventario
        $inventario = Inventario::find($request->id_inventario);
        $inventario->insumos()->save($insumo); //Se usa la relación 1:m "insumos" para asociar el insumo y se guarda

        //Se redirige después de almacenar el insumo
        return redirect()->route("insumo.index")->with('success', 'Insumo agregado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Insumo $insumo)
    {
        return view('insumos.show', compact('insumo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Insumo $insumo)
    {
        $inventarios = Inventario::all();
        return view('insumos.edit', compact('inventarios','insumo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Insumo $insumo)
    {
        $insumo->update($request->all());
        return redirect()->route("insumo.index")->with('updated', 'Insumo actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Insumo $insumo)
    {
        $insumo->delete();
        return redirect()->route("insumo.index")->with('deleted', 'Insumo eliminado con éxito');
    }
}
