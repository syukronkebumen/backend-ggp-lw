<?php

namespace App\Http\Livewire\Master;

use Livewire\Component;

use function Laravel\Prompts\alert;

class MasterMaterial extends Component
{
    public $openmodal = false;

    public function render()
    {
        return view('livewire.master.master-material');
    }

    public function openmodal(){
        $this->openmodal = true;
    }
}
