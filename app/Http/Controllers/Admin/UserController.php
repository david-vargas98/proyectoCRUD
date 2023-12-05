<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; //Se agrega la inclusión del modelo
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;  //Se hace la inclusión del modelo para los roles

class UserController extends Controller
{
    //Método constructor para el manejo de las rutas protegidas:
    // el método constructor (__construct) de un controlador se utiliza para realizar acciones específicas antes de que se ejecute cualquier método en ese controlador
    public function __construct()
    {
        //De esta manera se restringe el acceso a todas las rutas
        $this->middleware('can:admin.users.index');
        //De este otro modo se puede especificar uno por uno
        $this->middleware('can:admin.users.index')->only('index');
        $this->middleware('can:admin.users.edit')->only('edit', 'update');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //Se recupera el listado de roles
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //Se relaciona un usuario con un rol, el método sync se encarga de colocar nuevos registros en la tabla pivote
        $user->roles()->sync($request->roles);
        //Se retorna a la página anterior con un mensaje de sesión
        return redirect()->route('admin.users.edit', $user)->with('success','Se asignó los roles correctamente');
    }

    //Función para el desbloqueo
    public function desbloqueo(User $user)
    {
        //Se modifica en memoria temporal
        $user->attempts = 0;
        //Se perpetua en la base de datos
        $user->save();
        //Se redirige
        return redirect()->route('admin.users.edit', $user)->with('success','El usuario fue desbloqueado correctamente');
    }
}
