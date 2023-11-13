<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cliente;
use App\Models\ClienteUser; //Modelo de la relación en caso de no usar attach
use Illuminate\Http\Request;

class ClienteUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Se usa with() para el problema de las n+1 consultas
        $asociaciones = ClienteUSer::with('cliente')->paginate(4);
        return view("empleado.asociaciones.index", compact('asociaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $clientes = Cliente::all();
        return view('empleado.asociaciones.create', compact('users','clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validaciones
        $request->validate([
            'user_id'=> 'required',
            'cliente_id'=> 'required',
            'proyecto'=> 'required|string|max:20',
            'presupuesto'=> 'required|numeric|max:999999',
            'estado'=> ['required', 'in:Iniciado,Activo,Suspendido,Cancelado,Terminado'],
        ]);
        //Se asocia al usuario y al cliente usando attach
        //$user = User::find($request->input('user_id')); //Se busca el usuario con el valor del id proporcionado en el form
        //$cliente = Cliente::find($request->input('cliente_id')); //Lo mismo que el anterior, pero con el cliente
        ////SE usa la relación 'clientes' y attach para establecer una relación de m:m
        //$user->clientes()->attach($cliente->id, [ //el id del cliente que se quiere asociar al usuario
        //    //El arreglo asociativo contiene los demás atributos que se quieren guardar en la tabla cliente_user
        //    'proyecto' => $request->input('proyecto'),
        //    'presupuesto' => $request->input('presupuesto'),
        //    'estado' => $request->input('estado'),
        //]);

        //Se puede hacer también con el modelo ClienteUser, así:
        //Creación de la asociación
        $asociacion = ClienteUser::create([
            'user_id' => $request->input('user_id'), 
            'cliente_id' => $request->input('cliente_id'), 
            'proyecto' => $request->input('proyecto'),
            'presupuesto' => $request->input('presupuesto'),
            'estado' => $request->input('estado'),
        ]);

        //Redirección al index
        return redirect()->route('empleado.asociaciones.index')->with('Suceess', 'La asociación fue creada con éxito');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClienteUser $asociacion)
    {
        $clientes = Cliente::all();
        $users = User::all();
        return view('empleado.asociaciones.edit', compact('clientes', 'users', 'asociacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClienteUser $asociacion)
    {
        //Validaciones
        $request->validate([
            'user_id'=> 'required',
            'cliente_id'=> 'required',
            'proyecto'=> 'required|string|max:20',
            'presupuesto'=> 'required|numeric|max:999999',
            'estado'=> ['required', 'in:Iniciado,Activo,Suspendido,Cancelado,Terminado'],
        ]);
        //Actualización 
        $asociacion->update([
            'user_id' => $request->input('user_id'),
            'cliente_id' => $request->input('cliente_id'),
            'proyecto' => $request->input('proyecto'),
            'presupuesto' => $request->input('presupuesto'),
            'estado' => $request->input('estado'),
        ]);
        //Redirección
        return redirect()->route('empleado.asociaciones.index')->with('success', 'La asociación fue actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClienteUSer $asociacion)
    {
        //Se elimina
        $asociacion->delete();
        //Se redirige, al fin terminé!!
        return redirect()->route('empleado.asociaciones.index')->with('success', 'La asociación se borró con éxito');
    }
}
