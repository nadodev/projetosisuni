@extends('layouts.master')

@section('content')
<div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-900">Planos</h2>
            <div>
                <span class="mr-4 text-sm text-gray-600">
                    Plano Atual: {{ auth()->user()->instituicao->plan->name ?? 'Nenhum plano selecionado' }}
                </span>
                <span class="text-sm text-gray-600">
                    Convites Restantes: {{ auth()->user()->instituicao->plan->invite_limit - auth()->user()->instituicao->invites_used    }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            @foreach($plans as $plan)
                <div class="overflow-hidden bg-white rounded-lg shadow">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                            {{ $plan->name }}
                        </h3>
                        <div class="mt-2">
                            <p class="text-3xl font-bold text-gray-900">
                                {{ $plan->total_invite_limitinvites }} convites
                            </p>
                            <p class="mt-2 text-sm text-gray-500">
                                Limite de convites por instituição
                            </p>
                        </div>
                        @if(auth()->user()->instituicao->plan_id === $plan->id)
                            <span class="inline-flex items-center px-3 py-1 mt-4 text-sm font-medium text-green-800 bg-green-100 rounded-full">
                                Plano Atual
                            </span>
                        @else
                            <form action="{{ route('admin.plans.update', $plan) }}" method="POST" class="mt-4">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md border border-transparent shadow-sm hover:bg-blue-700">
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
