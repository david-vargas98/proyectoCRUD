<?php

namespace App\Livewire\Admin;

use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;

class PacientesIndex extends Component
{
    use WithPagination;
    public $search = '';
    protected $paginationTheme = "bootstrap";
    public function render()
    {
        $pacientes = Patient::whereHas('militaryElement', function ($query) {
            $query->where('name', 'LIKE', '%' . $this->search . '%');
        })->orWhereHas('userPsicologo', function ($query){
            $query->where('name', 'LIKE', '%' . $this->search . '%');
        })->paginate(4);
        return view('livewire.admin.pacientes-index', compact('pacientes'));
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
