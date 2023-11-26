<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\UserAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AppointmentController extends Controller
{
    //Método constructor para el manejo de las rutas protegidas
    public function __construct()
    {
        //Protección a la ruta index
        $this->middleware('can:citas.index')->only('index');
        //Protección a la ruta create y store
        $this->middleware('can:citas.create')->only('create', 'store');
        //Protección a la ruta edit y update
        $this->middleware('can:citas.edit')->only('edit', 'update');
        //Protección a la ruta show
        $this->middleware('can:citas.show')->only('show');
        //Protección a la ruta destroy
        $this->middleware('can:citas.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('empleado.citas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Se recupera el listado de pacientes que tienen asignado un psicólogo
        $pacientes = Patient::whereHas('militaryElement', function ($query) { //Se busca en la relación con militaryElements
            $query->whereNull('deleted_at'); //Excluye pacientes que sean elementos militares eliminados
        })->WhereNotNull('user_id')->get();  //Excluye pacientes que no tienen psicólogo asignado
        return view('empleado.citas.create', compact('pacientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validaciones:
        $request->validate([
            'patient_id'=> 'required',
            'appointment_date'=> 'required',
            'start_time'=> 'required',
            'appointment_status'=> 'required',
        ]);
        //Se crea el registro de la cita
        $cita = Appointment::create($request->all());
        //Registro de la acción del usuario
        $this->logUserAction('Crear', 'Citas', $cita->id);
        //Se redirige
        return redirect()->route('citas.index')->with('success','La cita ha sido creada con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $cita)
    {
        return view('empleado.citas.show', compact('cita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $cita)
    {
        return view('empleado.citas.edit', compact('cita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $cita)
    {
        //Validaciones:
        $request->validate([
            'patient_id'=> 'required',
            'appointment_date'=> 'required',
            'start_time'=> 'required',
            'appointment_status'=> 'required',
            'contrato'=> 'file|max:20000|mimes:jpeg,png,jpg,pdf',
        ]);
        //Actualización
        $cita->update($request->all());

        //Archivo:

        //Se verififca si tiene el checkbox y está seleccionado (por el hidden). O, si el checkbox se seleccionó para quitar el contrato actual. O, si está seleccionado el checkbox y hay un nuevo archivo
        if (($request->has('quitar_contrato') && $request->input('quitar_contrato') == 'on') || $request->input('quitar_contrato') == 'on' || ($request->has('quitar_contrato') && $request->hasFile('contrato'))) {
            //Se elimina el contrato actual
            if($cita->observations_location != null && Storage::disk('local')->exists($cita->observations_location))
            {
                //Se elimina del sistema de archivos
                Storage::disk('local')->delete($cita->observations_location);
            }

            //Se actualiza la base de datos a null para 'reiniciar' los valores a null por si las moscas
            $cita->update([
                'observations_location' => null,
                'observations_name' => null,
            ]);
            
            //Si la solicitud tiene el archivo y si el archivo es válido
            if($request->hasFile('contrato') && $request->file('contrato')->isValid())
            {
                //Se obtiene el archivo de la solicitud
                $archivoContrato = $request->file('contrato');

                //Se almacena el archivo en la carpeta 'contratos' dentro de 'local'
                $rutaContrato = $archivoContrato->store('contratos', 'local');

                //Se actualiza la ubicación y el nombre original del contrato en la base de datos
                $cita->update([
                    'observations_location' => $rutaContrato,
                    'observations_name' => $archivoContrato->getClientOriginalName(),
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
                $cita->update([
                    'observations_location' => $rutaContrato,
                    'observations_name' => $archivoContrato->getClientOriginalName(),
                ]);
            }
        }

        //Registro de la acción del usuario
        $this->logUserAction('Editar', 'Citas', $cita->id);

        //Se redirige
        return redirect()->route('citas.index')->with('success','La cita ha sido actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $cita)
    {
        //Registro de la acción del usuario
        $this->logUserAction('Borrar', 'Citas', $cita->id);
        //Se borra la instancia
        $cita->delete();
        //Se redirige
        return redirect()->route('citas.index')->with('deleted','El cita fue borrada con éxito');
    }

    //Método para descargar el archivo
    public function descargar(Appointment $cita)
    {
        //Se verifica que el archivo exista en la presunta ubicación, tan tan taaannn
        if (Storage::exists($cita->observations_location)) 
        {
            //Si es así, se descarga, wuuu :'D El segundo parámetro es el nombre con el que queremos que se descargue
            return Storage::download($cita->observations_location, $cita->observations_name);
        } 
        else
        {
            //Sino existe, da respuesta HTTP 404 indicando que el archivo no se puede encontrar
            return abort(404, 'Archivo no encontrado');
        }
    }

    //Método para visualizar los archivos
    public function ver(Appointment $cita)
    {
        //Se comprueba de que exista una ubicación de contrato antes de intentar acceder al archivo
        if ($cita->observations_location) 
        {
            //Se obtiene la ruta completa del archivo en el disco local, la función devuelve la ruta al directorio de almacenamiento local y luego se concatena con la ubicación del contrato obtenida del modelo
            $rutaArchivo = storage_path('app/' . $cita->observations_location);

            //Antes de enviar el archivo, se verifica si realmente existe en la ruta obtenida (podría no estar)
            if (file_exists($rutaArchivo)) {
                //Si el archivo existe, response() crea una respuesta y el navegador mostrará el archivo en esa ruta
                return response()->file($rutaArchivo);
            }
        }
        //Si no se encuentra, da respuesta HTTP 404 indicando que el archivo no se puede encontrar
        abort(404, 'Archivo no encontrado');
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
