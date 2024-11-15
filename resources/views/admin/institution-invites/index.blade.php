@extends('layouts.master')

@section('content')
    <div class="flex justify-between items-center mx-auto sm:px-6 lg:px-8">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Convites') }}
        </h2>
        <div class="flex gap-4 items-center">
            <span class="text-sm text-gray-600">
                Convites Restantes: {{ $remainingInvites }}
            </span>
            <a href="{{ route('admin.institution.invites.create') }}"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-indigo-600 rounded-md border border-transparent hover:bg-indigo-700">
                Novo Convite
            </a>
        </div>
    </div>
    <div class="py-12">

        <div class="mx-auto sm:px-6 lg:px-8">

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b">Email</th>
                                <th class="px-6 py-3 border-b">Tipo</th>
                                <th class="px-6 py-3 border-b">Status</th>
                                <th class="px-6 py-3 border-b">Data de Expiração</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invites as $invite)
                                <tr>
                                    <td class="px-6 py-4 border-b">{{ $invite->email }}</td>
                                    <td class="px-6 py-4 border-b">
                                        @if ($invite->role === 'user_teacher')
                                            Professor
                                        @else
                                            Aluno
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 border-b">
                                        @if ($invite->status === 'pending')
                                            Pendente
                                        @elseif($invite->status === 'accepted')
                                            Aceito
                                        @else
                                            Expirado
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 border-b">
                                        {{ $invite->expires_at->format('d/m/Y H:i') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $invites->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
