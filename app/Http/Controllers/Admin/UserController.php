<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; //Se agrega la inclusión del modelo
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;  //Se hace la inclusión del modelo para los roles

class UserController extends Controller
{
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
}
