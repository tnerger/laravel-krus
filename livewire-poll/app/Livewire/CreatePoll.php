<?php

namespace App\Livewire;

use Livewire\Component;

class CreatePoll extends Component
{
    // Alle public - Attribute sind auch direkt im Blade Template verfügbar.
    // Sie müssen nicht extra übergeben werden.
    public $title;
    public $options = ['First Option'];

    public function render()
    {
        return view('livewire.create-poll');
    }

    public function addOption()
    {
        $this->options[] = '';
    }

    // public function mount()
    // {
    //     // Methode, die einmal zum Start der Komponente aufgerufen wird
    //     // das kann man benutzen um Variablen zu füllen
    //     // z.B. wenn man etwas aus der DB holen muss
    // }
}
