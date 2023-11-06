<?php

namespace App\Livewire\Admin;

use App\Models\User;  //Se incluye el modelo
use Livewire\Component;

use Livewire\WithPagination; //Se incluye para usar la paginación

class UsersIndex extends Component
{
    //Se le dice que se quiere usar aquí:
    use WithPagination;

    //Propiedad de tipo public que se sincroniza con el input para buscar por nombre o correo
    public $search = '';
    //Se le indica a livewire que se quiere usar los estilos de paginación de bootstrap
    protected $paginationTheme = "bootstrap";
    public function render()
    {
        //Se recupera el listado de los usuarios pero paginados y filtrado
        $users = User::where('name', 'LIKE', '%'. $this->search . '%')
                    ->orWhere('email', 'LIKE', '%'. $this->search . '%')->paginate(5);

        return view('livewire.admin.users-index', compact('users')); //Se le pasa la variable
    }

    public function clearSearch()
    {
        $this->search = '';
    }
}
