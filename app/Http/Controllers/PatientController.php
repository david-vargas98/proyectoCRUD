<?php

namespace App\Http\Controllers;

use App\Models\HighSeverity;
use App\Models\LowSeverity;
use App\Models\MediumSeverity;
use App\Models\MilitaryElements;
use App\Models\Patient;
use App\Models\User;
use App\Models\UserAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('empleado.pacientes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $elementos = MilitaryElements::all();
        $psicologos = User::role('psicólogo')->get();
        return view('empleado.pacientes.create', compact('elementos', 'psicologos'));
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
            'user_id' => 'exists:users,id',
        ]);
        //Creación masiva
        $patient = Patient::create($request->all());
        //Registro de la acción del usuario
        $this->logUserAction('Crear', 'Pacientes', $patient->id);
        //Redirección
        return redirect()->route('pacientes.index')->with('success', 'El paciente fue asignado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $paciente)
    {
        //Instancias de las tablas
        $lowSeverityRecords = LowSeverity::all();
        $mediumSeverityRecords = MediumSeverity::all();
        $highSeverityRecords = HighSeverity::all();
        return view('empleado.pacientes.show', compact('paciente', 'lowSeverityRecords', 'mediumSeverityRecords', 'highSeverityRecords'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $paciente)
    {
        $elementos = MilitaryElements::all();
        $psicologos = User::role('psicólogo')->get();
        return view('empleado.pacientes.edit', compact('paciente', 'elementos', 'psicologos'));
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
            'user_id' => 'exists:users,id',
        ]);
        //Actualización masiva
        $paciente->update($request->all());

        //Registro de la acción del usuario
        $this->logUserAction('Editar', 'Pacientes', $paciente->id);

        //Redirección
        return redirect()->route('pacientes.index')->with('success', 'El paciente fue actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $paciente)
    {
        //Registro de la acción del usuario
        $this->logUserAction('Borrar', 'Pacientes', $paciente->id);
        //Borrado
        $paciente->delete();
        //Redirección
        return redirect()->route('pacientes.index')->with('deleted', 'El paciente fue borrado con éxito');
    }
    
    // Función para registrar la acción del usuario
    private function logUserAction($action, $tableName, $idPaciente)
    {
        //Crea un registro de tipo USerAction, se le pasan las columnas a llenar y los datos a usar
        UserAction::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'table_name' => $tableName,
            'record_id' => $idPaciente,
        ]);
    }
}
