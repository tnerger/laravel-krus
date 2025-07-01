<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Component;

class CreatePoll extends Component
{
    // Alle public - Attribute sind auch direkt im Blade Template verfügbar.
    // Sie müssen nicht extra übergeben werden.
    public $title;
    public $options = ['First Option'];

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'options' => 'required|array|min:1|max:10',
        'options.*' => 'required|min:1|max:255' //Validierung für jedes Item im Array

    ];

    protected $messages = [
        'options.*' => "The options can't be empty."
    ];

    public function render()
    {
        return view('livewire.create-poll');
    }

    public function addOption()
    {
        $this->options[] = '';
    }

    public function removeOption($index)
    {
        // das unerwünschte Element unsetten
        unset($this->options[$index]);
        // um den Index zu erhalten, das Array neu bilden
        $this->options = array_values($this->options);
    }

    public function updated($propName)
    {
        $this->validateOnly($propName);
    }

    public function createPoll()
    {
        $this->validate();
        Poll::create([
            'title' => $this->title
        ])->options()
            // createMany ermöglicht es eine Kollektion zurückzugeben
            // und so viele Optionen gleichezitig zu erzeugen
            ->createMany(
                collect($this->options) // Kollektion erzeugen
                    ->map(fn($option) => ['name' => $option]) // Ein Assoc Array erzeugen
                    ->all() // Array zurückgeben
            );

        // Oder einfach Oldschool:
        // foreach ($this->options as $optionName) {
        //     $poll->options()->create(['name' => $optionName]);
        // }

        $this->reset(['title', 'options']);
    }

    // public function mount()
    // {
    //     // Methode, die einmal zum Start der Komponente aufgerufen wird
    //     // das kann man benutzen um Variablen zu füllen
    //     // z.B. wenn man etwas aus der DB holen muss
    // }
}
