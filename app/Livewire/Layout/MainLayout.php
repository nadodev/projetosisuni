<?php

namespace App\Livewire\Layout;

use Livewire\Component;

class MainLayout extends Component
{
    public bool $sidebarOpen = true;

    public function toggleSidebar()
    {
        $this->sidebarOpen = !$this->sidebarOpen;
    }

    public function render()
    {
        return view('livewire.layout.main-layout');
    }
}
