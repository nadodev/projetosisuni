@extends('layouts.master')

@section('content')
<div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <h2 class="text-2xl font-semibold text-gray-900">Formulários Disponíveis</h2>

        <div class="mt-6 bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                @if($forms->isEmpty())
                    <p class="text-gray-500">Nenhum formulário disponível no momento.</p>
                @else
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($forms as $form)
                            <div class="p-4 border rounded-lg shadow-sm hover:shadow-md transition-shadow">
                                <h3 class="text-lg font-medium text-gray-900">{{ $form->name }}</h3>
                                <p class="mt-1 text-sm text-gray-500">{{ $form->description }}</p>
                                <div class="mt-4">
                                    <a href="{{ route('student.forms.show', $form) }}"
                                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                                        Ver Formulário
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
