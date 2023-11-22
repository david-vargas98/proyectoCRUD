<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\WithPagination;

class CitasIndex extends Component
{
    use WithPagination;
    public $search = '';
    protected $paginationTheme = "bootstrap";
    public function render()
    {
        $citas = Appointment::whereHas('patient.militaryElement', function ($query) {
            $query->where('name', 'LIKE', '%' . $this->search . '%');
        })->orWhereHas('patient.userPsicologo', function ($query) {
            $query->where('name', 'LIKE', '%' . $this->search . '%');
        })->paginate(4);

        return view('livewire.admin.citas-index', compact('citas'));
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
