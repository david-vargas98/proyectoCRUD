<?php

namespace App\Http\Controllers;

use App\Models\MilitaryElements;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = Patient::all();
        return view('empleado.pacientes.index', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $elementos = MilitaryElements::all();
        return view('empleado.pacientes.create', compact('elementos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validaciones
        $request->validate([
            'military_element_id'=> 'required|exists:military_elements,id|unique:patients,military_element_id',
            'disorder'=> 'required|in:TEPT',
            'severity'=> 'required|in:Bajo,Medio,Alto',
        ]);
        //Creación masiva
        $patient = Patient::create($request->all());
        //Redirección
        return redirect()->route('pacientes.index')->with('success', 'El paciente fue asignado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $paciente)
    {
        $elementos = MilitaryElements::all();
        return view('empleado.pacientes.edit', compact('paciente', 'elementos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $paciente)
    {
        //Validaciones
        $request->validate([
            'military_element_id'=> 'required|unique:patients,military_element_id,'.$paciente->id,
            'disorder'=> 'required|in:TEPT',
            'severity'=> 'required|in:Bajo,Medio,Alto',
        ]);
        //Actualización masiva
        $paciente->update($request->all());
        //Redirección
        return redirect()->route('pacientes.index')->with('success', 'El paciente fue actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $paciente)
    {
        //Borrado
        $paciente->delete();
        //Redirección
        return redirect()->route('pacientes.index')->with('deleted', 'El paciente fue borrado con éxito');
    }
}
