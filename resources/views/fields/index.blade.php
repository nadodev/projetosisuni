@extends('layouts.master')

@section('content')
<div class="w-full max-w-[900px] p-6 bg-white rounded-lg shadow-md">
    <h2 class="mb-4 text-2xl font-semibold text-gray-800">Gerenciar Campos</h2>
    <ul id="form-fields-list" class="space-y-2">
        @foreach($fields as $field)
            <li class="border-t p-2" data-id="{{ $field->id }}">
                <div class="flex justify-between items-center">
                    <div>
                        <span class="text-sm text-gray-700">{{ $field->name }}</span>
                        <span class="text-sm text-gray-500">({{ $field->type }})</span>
                    </div>
                    <div>
                        <a href="{{ route('fields.show', $field) }}" class="text-blue-500 hover:underline">Ver</a>
                        <a href="{{ route('fields.edit', $field) }}" class="ml-4 text-blue-500 hover:underline">Editar</a>
                        <form action="{{ route('fields.destroy', $field) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="ml-4 text-red-500 hover:underline">Deletar</button>
                        </form>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection
