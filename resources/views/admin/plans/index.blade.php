@extends('layouts.master')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-900">Planos</h2>
            <div>
                <span class="text-sm text-gray-600 mr-4">
                    Plano Atual: {{ auth()->user()->instituicao->plan->name ?? 'Nenhum plano selecionado' }}
                </span>
                <span class="text-sm text-gray-600">
                    Convites Restantes: {{ auth()->user()->instituicao->remaining_invites }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($plans as $plan)
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{ $plan->name }}
                        </h3>
                        <div class="mt-2">
                            <p class="text-3xl font-bold text-gray-900">
                                {{ $plan->invite_limit }} convites
                            </p>
                            <p class="mt-2 text-sm text-gray-500">
                                Limite de convites por instituição
                            </p>
                        </div>
                        @if(auth()->user()->instituicao->plan_id === $plan->id)
                            <span class="mt-4 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                Plano Atual
                            </span>
                        @else
                            <form action="{{ route('admin.plans.update', $plan) }}" method="POST" class="mt-4">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                                    Alterar Plano
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
