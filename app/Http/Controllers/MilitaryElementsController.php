<?php

namespace App\Http\Controllers;

use App\Models\MilitaryElements;
use App\Models\UserAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MilitaryElementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('empleado.elementosMilitares.index');
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

        //Registro de la acción del usuario
        $this->logUserAction('Crear', 'Elementos militares', $elemento->id);

        //Redirección
        return redirect()->route('elementosMilitares.index')->with('success', 'El elemento fue agregado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(MilitaryElements $elemento)
    {
        return view('empleado.elementosMilitares.show', compact('elemento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MilitaryElements $elemento)
    {
        return view('empleado.elementosMilitares.edit', compact('elemento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MilitaryElements $elemento)
    {
        //Validaciones again
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
        $elemento->update($request->all());

        //Registro de la acción del usuario
        $this->logUserAction('Editar', 'Elementos militares', $elemento->id);

        //Redirección
        return redirect()->route('elementosMilitares.index')->with('success', 'El elemento fue actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MilitaryElements $elemento)
    {
        //Registro de la acción del usuario
        $this->logUserAction('Borrar', 'Elementos militares', $elemento->id);
        //Borrado
        $elemento->delete();
        //Redirección
        return redirect()->route('elementosMilitares.index')->with('deleted', 'El elemento fue borrado con éxito');
    }

    // Función para registrar la acción del usuario
    private function logUserAction($action, $tableName, $idElement)
    {
        //Crea un registro de tipo USerAction, se le pasan las columnas a llenar y los datos a usar
        UserAction::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'table_name' => $tableName,
            'record_id' => $idElement,
        ]);
    }
}
