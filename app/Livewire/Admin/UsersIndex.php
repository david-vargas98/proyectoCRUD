<?php

namespace App\Livewire\Admin;

use App\Models\User;  //Se incluye el modelo
use Livewire\Component;

use Livewire\WithPagination; //Se incluye para usar la paginación

class UsersIndex extends Component
{
    //Se le dice que se quiere usar aquí:
    use WithPagination;

    //Se le indica a livewire que se quiere usar los estilos de paginación de bootstrap
    protected $paginationTheme = "bootstrap";
    public function render()
    {
        //Se recupera el listado de los usuarios pero paginados
        $users = User::paginate();

        return view('livewire.admin.users-index', compact('users')); //Se le pasa la variable
    }
}
