<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Convites') }}
            </h2>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-600">
                    Convites Restantes: {{ $remainingInvites }}
                </span>
                <a href="{{ route('institution.invites.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                    Novo Convite
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                            @foreach($invites as $invite)
                            <tr>
                                <td class="px-6 py-4 border-b">{{ $invite->email }}</td>
                                <td class="px-6 py-4 border-b">
                                    @if($invite->role === 'user_teacher')
                                        Professor
                                    @else
                                        Aluno
                                    @endif
                                </td>
                                <td class="px-6 py-4 border-b">
                                    @if($invite->status === 'pending')
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
</x-app-layout>
