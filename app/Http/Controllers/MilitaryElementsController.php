<?php

namespace App\Http\Controllers;

use App\Models\MilitaryElements;
use Illuminate\Http\Request;

class MilitaryElementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $elementos = MilitaryElements::paginate(4);
        return view('empleado.elementosMilitares.index', compact('elementos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empleado.elementosMilitares.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validaciones
        $request->validate([
            'name' => 'required|string|max:60',
            'birthdate' => 'required|date',
            'cellphone' => 'required|string|regex:/\d{10}/',
            'address' => 'required|string|max:70',
            'admission' => 'required|date',
            'militarygrade' => 'required|string|max:20',
            'location' => 'required|string|max:20',
            'unit' => 'required|string|max:20',
            'servicestate' => 'required|in:Activo,Suspendido,Evaluación,Terminado',
        ]);

        //Se hace la asignación masiva
        $elemento = MilitaryElements::create($request->all());

        //Redirección
        return redirect()->route('elementosMilitares.index')->with('success', 'El elemento fue agregado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(MilitaryElements $militaryElements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MilitaryElements $militaryElements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MilitaryElements $militaryElements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MilitaryElements $militaryElements)
    {
        //
    }
}
