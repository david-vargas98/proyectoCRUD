<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::paginate(3);
        return view('empleado.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("empleado.clientes.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validaciones
        $request->validate([
            'nombrecliente' =>'required|string|max:50',
            'apellidopat'=> 'required|string',
            'apellidomat'=> 'required|string',
            'fechanacimiento'=> 'required|date',
            'correo'=> 'required|email|max:30',
            'telefono'=> 'required|numeric',
            'direccion'=> 'required|string|max:40',
            'ciudad'=> 'required|string|max:30',
            'estado'=> 'required|string|max:30',
            'pais'=> 'required|string|max:30',
        ]);
        //Si pasa la validación, se le pasa al método create lo que se manda desde el formulario:
        $cliente = Cliente::create($request->all());
        //Redirección
        return redirect()->route('empleado.clientes.index')->with('success','El cliente se agregó con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        return view('empleado.clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //Se crea una instancia del usuario autenticado
        $user = Auth::user();
        //Verifica la policy pasando por parámetro el método a llamar y se pasa el parámetro de tipo User que espera
        $this->authorize('esEmpleado', $user);
        return view('empleado.clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        //Validaciones
        $request->validate([
            'nombrecliente' =>'required|string|max:50',
            'apellidopat'=> 'required|string',
            'apellidomat'=> 'required|string',
            'fechanacimiento'=> 'required|date',
            'correo'=> 'required|email|max:30',
            'telefono'=> 'required|numeric',
            'direccion'=> 'required|string|max:40',
            'ciudad'=> 'required|string|max:30',
            'estado'=> 'required|string|max:30',
            'pais'=> 'required|string|max:30',
        ]);
        //Si pasa la validación, se le pasa al método create lo que se manda desde el formulario:
        $cliente->update($request->all());
        //Redirección
        return redirect()->route('empleado.clientes.index')->with('success','Se actulizó la información del cliente con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //Se crea una instancia del usuario autenticado
        $user = Auth::user();
        //Verifica la policy pasando por parámetro el método a llamar y se pasa el parámetro de tipo User que espera
        $this->authorize('esEmpleado', $user);
        //Se borra y retorna
        $cliente->delete();
        return redirect()->route('empleado.clientes.index')->with('success','El cliente se eliminó con exito');
    }
}
