<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Anamnese;
use App\Observers\AnamneseObserver;
use Livewire\Livewire;
use App\Livewire\Students\EducationalProfile;

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
    }
}
