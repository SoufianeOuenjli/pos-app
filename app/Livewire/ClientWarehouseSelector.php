<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ClientWarehouseSelector extends Component
{
    public $client = "";

    public function handleClient()
    {
        // dd($this->client);
        $this->dispatch('clientSelected', $this->client);
    }

    public function render()
    {
        $clients = User::where('id' ,'!=', 1)->get();
        return view('livewire.client-warehouse-selector', compact('clients'));
    }
}
