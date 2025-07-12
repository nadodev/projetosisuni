@extends('layouts.master')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Respostas para {{ $form->name }}</h2>
    <table class="w-full table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Data</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Respostas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($responses as $response)
                <tr class="border-t">
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $response->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">
                        @foreach(json_decode($response->responses, true) as $key => $value)
                            <strong>{{ $key }}:</strong> {{ $value }}<br>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
