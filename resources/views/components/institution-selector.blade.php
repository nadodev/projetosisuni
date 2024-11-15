<div class="relative">
    @if(isset(auth()->user()->institutions) && auth()->user()->institutions->count() > 0)
        <form method="POST" action="{{ route('switch.institution') }}" id="institutionForm">
            @csrf
            <select name="switch_institution"
                    onchange="document.getElementById('institutionForm').submit()"
                    class="block py-2 pr-10 pl-3 w-64 text-sm bg-white rounded-md border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @foreach(auth()->user()->institutions as $institution)
                    <option value="{{ $institution->id }}"
                            {{ auth()->user()->current_institution_id == $institution->id ? 'selected' : '' }}>
                        {{ $institution->nome }}
                    </option>
                @endforeach
            </select>
            <noscript>
                <button type="submit" class="px-4 py-2 mt-2 text-white bg-blue-500 rounded">Trocar Instituição</button>
            </noscript>
        </form>
    @else
        <span class="px-3 py-2 text-sm text-gray-500">Nenhuma instituição disponível</span>
    @endif
</div>

<style>
    select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
    }

    select:focus {
        border-color: #6366f1;
        outline: none;
        box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
    }
</style>
