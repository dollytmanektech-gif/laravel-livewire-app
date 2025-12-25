<?php

namespace App\Livewire;

use App\Models\Greeting;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Counter extends Component
{
    public $count = 1;

    #[Validate('required|min:2')]
    public $name = '';

    public $greeting = '';
    public $greetings = [];
    public $greetingMessage = '';

    public function changeGreetings()
    {
        $this->validate();
        $this->greetingMessage = "{$this->greeting} {$this->name}!!!";
    }

    public function mount(){
        $this->greetings = Greeting::all();
    }

    public function updatedName($value){
        $this->name = strtolower($value);
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
