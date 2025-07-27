<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;

class Contato extends Component
{
    public function render()
    {
        return view('livewire.contato')->layout('layouts.landing');;
    }
} 