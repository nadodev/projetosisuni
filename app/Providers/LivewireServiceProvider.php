<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use App\Livewire\Students\EducationalProfile;
use App\Livewire\Privacidade;
use App\Livewire\TermosUso;

class LivewireServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Livewire::component('students.educational-profile', EducationalProfile::class);
        Livewire::component('privacidade', Privacidade::class);
        Livewire::component('termos-uso', TermosUso::class);
    }
} 