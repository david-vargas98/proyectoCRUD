<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //Se agrega el Auth de "Facades"

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Se regresa todo, se puede usar get() en su lugar, hace casi lo mismo
        $inventarios = Inventario::first()->paginate(4); //Esta línea la coleeción de los registros de la tabla en la variable
        //Retorna la vista a esa ruta en inventario-index.blade.php
        return view('inventario-index', compact('inventarios')); //Se usa compact para pasar la variable a esa vista: Esto significa que la vista tendrá acceso a la variable $inventarios y podrá mostrar la lista de inventarios.
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Retorna la vista a esa ruta en inventario-index.blade.php
        return view('inventario-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validación para los valores de entrada (investigar)
        $request->validate([
            //Esta validación asegura que no se repitan valores, que sea 255 caracteres max, y que sea string solamente y ER
            'descripcion' => ['required','unique:inventarios','min:3','max:255','string','regex:/^[A-Za-z0-9\s\-]+$/']
        ]);

        //Almacenamiento del registro (Tradicional)
        //$inventario = new Inventario(); //Instancia del modelo Inventario
        //$inventario->descripcion = $request->descripcion;
        //$inventario->save();

        //Antes de agregar el registro, se debe agregar o sobrescribir el valor en la solicitud ($request) antes de que esta sea procesada:
        //Este método permite fusionar un conjunto de datos con la solicitud actual. En este caso, se está fusionando un array asociativo con la solicitud:-->Está asignando el valor del ID del usuario autenticado (Auth::id()) a la clave user_id.
        $request->merge(['user_id'=> Auth::id()]); //Aquí se obtiene quién estpa haciendo qué.

        //Simplificación del almacenamiento del registro:
        //Se usa el Mass Assignment, o "Asignación Masiva", es una técnica en Laravel que permite asignar múltiples valores a un modelo al mismo tiempo, generalmente provenientes de un formulario HTTP o de cualquier array asociativo. Esto es especialmente útil al crear o actualizar varios registros a la vez.
        //Nota: Esto supone que los campos en $request->all() deben coincidir con los nombres de las columnas en la tabla de la base de datos.
        Inventario::create($request->all()); //Después se debe agregar el fillable en el modelo.
        
        //Mensaje flash, la sesión se llama success y se muestra el mensaje del segundo parámetro
        session()->flash('success', 'El registro se ha creado con éxito UwU');

        //Se redirige a la url última petición
        return redirect()->route('inventario.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventario $inventario)
    {
        //Para acceder a los inventarios se hace por ID, así: proyectocrud.test/inventario/1
        //Se devuelve la vista inventario-show y se pasa la variable $inventario a esa vista utilizando la función compact. Esto significa que la vista tendrá acceso al objeto de inventario específico.
        return view('inventario-show', compact('inventario')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventario $inventario)
    {
        //Se reusa el de agregar pero con los campos ya recuperando la info
        return view('inventario-edit', compact('inventario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventario $inventario)
    {
        //Validación para los valores a modificar:
        $request->validate([
            //Esta validación asegura que no se repitan valores, que sea 255 caracteres max, y que sea string solamente y ER
            'descripcion' => ['required','unique:inventarios','min:3','max:255','string','regex:/^[A-Za-z0-9\s\-]+$/']
        ]);
        //Recepción de la modificación de edit para asignar el nuevo valor:
        // Aquí solo se tiene en memoria temporal/ram
        //$inventario->descripcion = $request->descripcion;
        //Aquí se perpetua con save() en la base de datos
        //$inventario->save();

        //Método simplificado para sginar el nuevo valor:
        //Se busca por id el registro en la tabla 'inventarios' y se actualiza todo excepto los valores indicados:
        Inventario::where('id', $inventario->id)->update($request->except('_token', '_method')); //Se debe agregar el fillable en el modelo.

        //Mensaje flash, la sesión se llama update y se muestra el mensaje del segundo parámetro
        session()->flash('update', 'El registro se ha modificado con éxito UvU');

        //Se redirige a el index
        return redirect()->route('inventario.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventario $inventario)
    {
        //Se usa el objeto con su método deleye
        $inventario->delete();

        //Mensaje flash, la sesión se llama delete y se muestra el mensaje del segundo parámetro
        session()->flash('delete', 'El registro se ha borrado con éxito UnU');

        //Se redirige al index
        return redirect()->route('inventario.index');
    }
}
