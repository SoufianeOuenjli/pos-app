<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Commande;
use Livewire\WithPagination;

class Commandes extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $commandes = Commande::with(['client', 'modeReglement', 'details.article'])
                ->latest()
                ->paginate(5);
        return view('livewire.commandes', compact('commandes'));
    }
}
