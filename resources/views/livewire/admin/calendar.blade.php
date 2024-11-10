<div class="p-6">
    <div class="flex justify-between mb-4">
        <h2 class="text-2xl font-semibold">Calendário</h2>
        <div class="flex items-center gap-4">
            <select wire:model.live="selectedUserId" class="rounded-md border-gray-300 shadow-sm">
                <option value="{{ auth()->id() }}">Meus Eventos</option>
                @foreach($users as $user)
                    @if($user->id !== auth()->id())
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endif
                @endforeach
            </select>
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

    Livewire.on('calendar-update', function(data) {
        calendar.removeAllEvents();
        calendar.addEventSource(data.events);
    });
</script>
@endpush
