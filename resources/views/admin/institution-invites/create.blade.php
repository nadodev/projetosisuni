
@extends('layouts.master')

@section('content')
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Criar Novo Convite') }}
        </h2>
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <form method="POST" action="{{ route('admin.institution.invites.store') }}">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="role" :value="__('Tipo de Usuário')" />
                        <select id="role" name="role" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">
                            <option value="user_teacher">Professor</option>
                            <option value="user_student">Aluno</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <div class="flex justify-end items-center mt-4">
                        <x-primary-button class="ml-4">
                            {{ __('Enviar Convite') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
