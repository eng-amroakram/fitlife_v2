<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Trix extends Component
{
    public $trixId;

    public function mount($value)
    {
        $this->{$value} = "";
        $this->trixId = 'trix-' . uniqid();
    }

    public function render()
    {
        return view('livewire.trix');
    }

    public function updatedValue($value)
    {
        dd($value);
    }
}
