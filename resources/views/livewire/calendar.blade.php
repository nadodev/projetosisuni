<div class="p-6">
    <div class="flex justify-between mb-4">
        <h2 class="text-2xl font-semibold">Calendário</h2>
        <div class="flex items-center gap-4">
            @if(auth()->user()->isSuperAdmin())
                <div class="flex items-center gap-2">
                    <select wire:model="selectedUserId"
                        class="rounded-md border-gray-300 shadow-sm">
                        <option value="{{ auth()->id() }}">Meus Eventos</option>
                        @foreach($users as $user)
                            @if($user->id !== auth()->id())
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <button wire:click="filterEvents"
                        class="px-3 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                        Filtrar
                    </button>
                </div>
            @endif
        </div>
    </div>

    <div id="calendar"></div>
</div>

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>
    let calendar;

    document.addEventListener('livewire:initialized', function () {
        calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
            initialView: 'dayGridMonth',
            locale: 'pt-br',
            events: @json($events),
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            }
        });
        calendar.render();
    });

    Livewire.on('updateCalendar', function(data) {
        if (calendar) {
            calendar.getEventSources().forEach(source => source.remove());
            calendar.addEventSource(data.events);
        }
    });
</script>
@endpush
