<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Anamnese;
use App\Observers\AnamneseObserver;
use Livewire\Livewire;
use App\Livewire\Students\EducationalProfile;
use App\Livewire\Privacidade;
use App\Livewire\TermosUso;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Anamnese::observe(AnamneseObserver::class);

        Livewire::component('students.educational-profile', EducationalProfile::class);
        Livewire::component('privacidade', Privacidade::class);
        Livewire::component('termos-uso', TermosUso::class);
    }
}
