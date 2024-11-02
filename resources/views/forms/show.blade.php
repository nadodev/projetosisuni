@extends('layouts.master')

@section('content')
<div class="w-full max-w-[900px] p-6  bg-white rounded-lg shadow-md">
    <h2 class="mb-4 text-2xl font-semibold text-gray-800">{{ ucfirst($form->name) }}</h2>
    <form action="{{ route('forms.submit', $form) }}" method="POST">
        @csrf
        @foreach($fields as $field)
            <div class="mb-4">
                <label for="{{ $field->name }}" class="block text-sm font-medium text-gray-700">{{ ucfirst($field->name) }}</label>
                @if($field->type === 'text')
                    <input type="text" name="{{ $field->name }}" id="{{ $field->name }}" class="w-full py-2 pl-2 mt-1 border border-gray-200 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                @elseif($field->type === 'number')
                    <input type="number" name="{{ $field->name }}" id="{{ $field->name }}" class="w-full py-2 pl-2 mt-1 border border-gray-200 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                @elseif($field->type === 'textarea')
                    <textarea name="{{ $field->name }}" id="full-featured-non-premium" class="w-full py-2 pl-2 mt-1 border border-gray-200 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
                @endif
            </div>
        @endforeach
        <button type="submit" class="px-4 py-2 text-white transition-colors duration-200 bg-blue-500 rounded-md hover:bg-blue-600">Enviar</button>
    </form>
</div>
@endsection
