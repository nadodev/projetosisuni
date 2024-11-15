@extends('layouts.master')

@section('content')
<div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <h2 class="text-2xl font-semibold text-gray-900">Enviar Convite</h2>

        @if(auth()->user()->currentInstitution)
            @if(auth()->user()->currentInstitution->canSendInvite())
                <div class="text-sm text-gray-600 mb-4">
                    Convites disponíveis: {{ auth()->user()->currentInstitution->getRemainingInvites() }}
                </div>

                <form action="{{ route('admin.institution.invites.store') }}" method="POST" class="bg-white shadow sm:rounded-lg p-6">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                        <input type="email" name="email" id="email" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="role" class="block text-sm font-medium text-gray-700">Função</label>
                        <select name="role" id="role" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="user_admin">Administrador</option>
                            <option value="user_teacher">Professor</option>
                            <option value="user_student">Aluno</option>
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Enviar Convite
                        </button>
                    </div>
                </form>
            @else
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    Você atingiu o limite de convites do seu plano atual.
                </div>
            @endif
        @else
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                Selecione uma instituição para enviar convites.
            </div>
        @endif
    </div>
</div>
@endsection
