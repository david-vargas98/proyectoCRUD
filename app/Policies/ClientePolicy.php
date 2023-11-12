<?php

namespace App\Policies;

use App\Models\User;

class ClientePolicy
{
   //Se crea una regla de autorización mediante un método
    public function esEmpleado(User $user)  //Toma al usuario autenticado en automático
    {
        // Verificar información de los roles del usuario
        return $user->hasAnyRole('admin', 'empleado');
    }
}
