<?php

namespace App\Livewire\Admin;

use App\Models\MilitaryElements;
use Livewire\Component;
use Livewire\WithPagination;

class ElementosMilitaresIndex extends Component
{
    use WithPagination;
    public $search = '';
    protected $paginationTheme = "bootstrap";
    public function render()
    {
        $elementos = MilitaryElements::where('name', 'LIKE', '%' . $this->search . '%')->paginate(4);
        return view('livewire.admin.elementos-militares-index', compact('elementos'));
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
