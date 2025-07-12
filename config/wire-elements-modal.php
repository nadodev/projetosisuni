<?php

return [
    'default_modal_component' => null,
    'middleware' => ['web', 'auth'],
    'include_js' => true,
    'include_css' => true,
    'components' => [
        'students.educational-profile' => App\Livewire\Students\EducationalProfile::class,
    ],
]; 