<?php

declare(strict_types=1);

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;

class Privacidade extends ModalComponent
{
    public function render()
    {
        return view('livewire.privacidade')->layout('layouts.landing');;
    }
} 