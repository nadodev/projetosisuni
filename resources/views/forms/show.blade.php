@extends('layouts.master')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ $form->name }}</h2>
    <form action="{{ route('forms.submit', $form) }}" method="POST">
        @csrf
        @foreach($fields as $field)
            <div class="mb-4">
                <label for="{{ $field->name }}" class="block text-sm font-medium text-gray-700">{{ $field->name }}</label>
                @if($field->type === 'text')
                    <input type="text" name="{{ $field->name }}" id="{{ $field->name }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                @elseif($field->type === 'number')
                    <input type="number" name="{{ $field->name }}" id="{{ $field->name }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                @elseif($field->type === 'textarea')
                    <textarea name="{{ $field->name }}" id="{{ $field->name }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
                @endif
            </div>
        @endforeach
        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition-colors duration-200">Enviar</button>
    </form>
</div>
@endsection
