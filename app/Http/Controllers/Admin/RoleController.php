<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role; //Importación del modelo de roles
use Spatie\Permission\Models\Permission; //Se importa el modelo de los permisos

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Se recupera el listado de roles para mostrarlos
        $roles = Role::all();
        return view("admin.roles.index", compact("roles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Se recupera el listado de los permisos
        $permisos = Permission::all();
        return view("admin.roles.create", compact('permisos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validaciones
        $request->validate([
            'name' =>'required',
        ]);
        //Si pasa la validación, se le pasa al método create lo que se manda desde el formulario:
        $role = Role::create($request->all());
        //Sincronización con los permisos seleccionados, para eso se accede a la relación permissions:
        $role->permissions()->sync($request->permissions); //Esta línea asigna los permisos
        //Registro de la acción del usuario
        $this->logUserAction('Crear', 'Lista de roles', $role->id);
        //Redirección
        return redirect()->route('admin.roles.edit', $role)->with('success','El rol se creó con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view("admin.roles.show", compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //Se recupera el listado de los permisos
        $permisos = Permission::all();
        return view("admin.roles.edit", compact('role', 'permisos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //Validaciones
        $request->validate([
            'name' =>'required',
        ]);
        //Si pasa, se actualiza
        $role->update($request->all());
        //Se sincroniza el rol con los permisos
        $role->permissions()->sync($request->permissions); //Esta línea asigna los permisos
        //Registro de la acción del usuario
        $this->logUserAction('Editar', 'Lista de roles', $role->id);
        //Redirección
        return redirect()->route('admin.roles.edit', $role)->with('success','El rol se actualizó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        //Registro de la acción del usuario
        $this->logUserAction('Borrar', 'Lista de roles', $role->id);
        return redirect()->route('admin.roles.index')->with('success','El rol se eliminó con éxito');
    }

    // Función para registrar la acción del usuario
    private function logUserAction($action, $tableName, $idRol)
    {
        //Crea un registro de tipo USerAction, se le pasan las columnas a llenar y los datos a usar
        UserAction::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'table_name' => $tableName,
            'record_id' => $idRol,
        ]);
    }
}
