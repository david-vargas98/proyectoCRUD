<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cliente;
use App\Models\ClienteUser; //Modelo de la relación en caso de no usar attach
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'contrato'=> 'required|file|max:20000',
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

        //Se verifica si se cargó, y si es valido el archivo
        if ($request->hasFile('contrato') && $request->file('contrato')->isValid())
        {
            //Se obtiene el archivo válido
            $archivoContrato = $request->file('contrato');

            //Se almacena el archivo en la carpeta "contratos" dentro de la carpeta "storage/app", si la carpeta no existe, la crea
            $rutaContrato = $archivoContrato->store('contratos', 'public');

            //Se guarda la ubicación y el nombre original del contrato en la base de datos
            $asociacion->contrato_ubicacion = $rutaContrato;
            $asociacion->contrato_nombre = $archivoContrato->getClientOriginalName();
            $asociacion->save();
        }

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
            'contrato'=> 'file|max:20000',
        ]);
        //Actualización 
        $asociacion->update([
            'user_id' => $request->input('user_id'),
            'cliente_id' => $request->input('cliente_id'),
            'proyecto' => $request->input('proyecto'),
            'presupuesto' => $request->input('presupuesto'),
            'estado' => $request->input('estado'),
        ]);
        //Lógica apara los archivos teniendo un contrato:

        //Se verififca si tiene el checkbox y está seleccionado (por el hidden). O, si el checkbox se seleccionó para quitar el contrato actual. O, si está seleccionado el checkbox y hay un nuevo archivo
        if (($request->has('quitar_contrato') && $request->input('quitar_contrato') == 'on') || $request->input('quitar_contrato') == 'on' || ($request->has('quitar_contrato') && $request->hasFile('contrato'))) {
            //Se elimina el contrato actual
            if($asociacion->contrato_ubicacion != null && Storage::disk('public')->exists($asociacion->contrato_ubicacion))
            {
                //Se elimina del sistema de archivos
                Storage::disk('public')->delete($asociacion->contrato_ubicacion);
            }

            //Se actualiza la base de datos a null para 'reiniciar' los valores a null por si las moscas
            $asociacion->update([
                'contrato_ubicacion' => null,
                'contrato_nombre' => null,
            ]);
            
            //Si la solicitud tiene el archivo y si el archivo es válido
            if($request->hasFile('contrato') && $request->file('contrato')->isValid())
            {
                //Se obtiene el archivo de la solicitud
                $archivoContrato = $request->file('contrato');

                //Se almacena el archivo en la carpeta 'contratos' dentro de 'public'
                $rutaContrato = $archivoContrato->store('contratos', 'public');

                //Se actualiza la ubicación y el nombre original del contrato en la base de datos
                $asociacion->update([
                    'contrato_ubicacion' => $rutaContrato,
                    'contrato_nombre' => $archivoContrato->getClientOriginalName(),
                ]);
            }
        }
        else //Lógica apara los archivos sin tener un contrato:
        {
            //Si la solicitud tiene el archivo y si el archivo es válido
            if($request->hasFile('contrato') && $request->file('contrato')->isValid())
            {
                //Se obtiene el archivo de la solicitud
                $archivoContrato = $request->file('contrato');

                //Se almacena el archivo en la carpeta 'contratos' dentro de 'public'
                $rutaContrato = $archivoContrato->store('contratos', 'public');

                //Se actualiza la ubicación y el nombre original del contrato en la base de datos
                $asociacion->update([
                    'contrato_ubicacion' => $rutaContrato,
                    'contrato_nombre' => $archivoContrato->getClientOriginalName(),
                ]);
            }
        }
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
