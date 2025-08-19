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
    public $search = ''; //se utiliza para sincronizar con un campo de búsqueda en la interfaz de usuario
    //Se le indica a livewire que se quiere usar los estilos de paginación de bootstrap
    protected $paginationTheme = "bootstrap";
    public function render() //se llama automáticamente cuando el componente Livewire se renderiza
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

    //Método que se usa para resetear la información de la página y poder realizar correctamente las búsquedas
    public function updatingSearch() //se ejecuta automáticamente cuando la propiedad $search se actualiza
    {
        $this->resetPage(); //restablece la información de la página, lo que garantiza que la paginación funcione correctamente al realizar búsquedas
    }
}
