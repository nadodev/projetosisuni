<?php

declare(strict_types=1);

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;

class TermosUso extends ModalComponent
{
    public function render()
    {
        return view('livewire.termos-uso')->layout('layouts.landing');;
    }
} 