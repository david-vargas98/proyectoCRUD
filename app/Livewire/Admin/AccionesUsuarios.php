<?php

namespace App\Livewire\Admin;

use App\Models\UserAction;
use Livewire\Component;
use Livewire\WithPagination;

class AccionesUsuarios extends Component
{
    use WithPagination;
    public $search = '';
    protected $paginationTheme = "bootstrap";
    public function render()
    {
        $userActions = UserAction::whereHas('user', function ($query) {
            $query->where('name', 'LIKE', '%' . $this->search . '%');
        })->orwhere('action', 'LIKE', '%' . $this->search . '%')
        ->orwhere('table_name', 'LIKE', '%' . $this->search . '%')
        ->orwhere('record_id', 'LIKE', '%' . $this->search . '%')->paginate(4);

        return view('livewire.admin.acciones-usuarios', compact('userActions'));
    }

    public function clearSearch()
    {
        $this->search = '';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
