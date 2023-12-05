<?php

namespace App\Http\Controllers;

use App\Mail\NotificaClienteUser;
use App\Models\User;
use App\Models\Cliente;
use App\Models\ClienteUser; //Modelo de la relación en caso de no usar attach
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; //Modelo para hacer uso del envío de correos
use Illuminate\Support\Facades\Storage; //Se utiliza para el manejo de los archivos

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
            'contrato'=> 'file|max:20000|mimes:jpeg,png,jpg,pdf',
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
            $rutaContrato = $archivoContrato->store('contratos', 'local');

            //Se guarda la ubicación y el nombre original del contrato en la base de datos
            $asociacion->contrato_ubicacion = $rutaContrato;
            $asociacion->contrato_nombre = $archivoContrato->getClientOriginalName();
            $asociacion->save();
        }

        //Envío de correo electrónico al usuario sujeto a la asociación:
        Mail::to($asociacion->user->email)->send(new NotificaClienteUser($asociacion));

        //Redirección al index
        return redirect()->route('empleado.asociaciones.index')->with('success', 'La asociación fue creada con éxito');
    }

    //Siempre si se implementa show
    public function show(ClienteUser $asociacion)
    {
        return view('empleado.asociaciones.show', compact('asociacion'));
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
            'contrato'=> 'file|max:20000|mimes:jpeg,png,jpg,pdf',
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
            if($asociacion->contrato_ubicacion != null && Storage::disk('local')->exists($asociacion->contrato_ubicacion))
            {
                //Se elimina del sistema de archivos
                Storage::disk('local')->delete($asociacion->contrato_ubicacion);
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

                //Se almacena el archivo en la carpeta 'contratos' dentro de 'local'
                $rutaContrato = $archivoContrato->store('contratos', 'local');

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

                //Se almacena el archivo en la carpeta 'contratos' dentro de 'local'
                $rutaContrato = $archivoContrato->store('contratos', 'local');

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

    //Método para descargar el archivo
    public function descargar(ClienteUSer $asociacion)
    {
        //Se verifica que el archivo exista en la presunta ubicación, tan tan taaannn
        if ($asociacion->contrato_ubicacion != null && Storage::exists($asociacion->contrato_ubicacion)) 
        {
            //Si es así, se descarga, wuuu :'D El segundo parámetro es el nombre con el que queremos que se descargue
            return Storage::download($asociacion->contrato_ubicacion, $asociacion->contrato_nombre);
        } 
        else
        {
            //Sino existe, da respuesta HTTP 404 indicando que el archivo no se puede encontrar
            return abort(404, 'Archivo no encontrado');
        }
    }

    //Método para visualizar los archivos
    public function ver(ClienteUSer $asociacion)
    {
        //Se comprueba de que exista una ubicación de contrato antes de intentar acceder al archivo
        if ($asociacion->contrato_ubicacion) 
        {
            //Se obtiene la ruta completa del archivo en el disco local, la función devuelve la ruta al directorio de almacenamiento local y luego se concatena con la ubicación del contrato obtenida del modelo
            $rutaArchivo = storage_path('app/' . $asociacion->contrato_ubicacion);

            //Antes de enviar el archivo, se verifica si realmente existe en la ruta obtenida (podría no estar)
            if (file_exists($rutaArchivo)) {
                //Si el archivo existe, response() crea una respuesta y el navegador mostrará el archivo en esa ruta
                return response()->file($rutaArchivo);
            }
        }
        //Si no se encuentra, da respuesta HTTP 404 indicando que el archivo no se puede encontrar
        abort(404, 'Archivo no encontrado');
    }
}
