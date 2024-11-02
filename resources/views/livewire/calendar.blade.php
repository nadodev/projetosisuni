<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Adicionar Evento</h2>
        <form wire:submit.prevent="createEvent" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="col-span-4 md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Título do Evento</label>
                <input
                    type="text"
                    wire:model="title"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:border-blue-500"
                    placeholder="Digite o título do evento"
                >
                @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Data Início</label>
                <input
                    type="datetime-local"
                    wire:model="start"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:border-blue-500"
                >
                @error('start') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Data Fim</label>
                <input
                    type="datetime-local"
                    wire:model="end"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:border-blue-500"
                >
                @error('end') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="col-span-4">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-200 flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    <span>Adicionar Evento</span>
                </button>
            </div>
        </form>
    </div>

    <div class="border rounded-lg p-4">
        <div id="calendar" wire:ignore></div>
    </div>

    {{-- Modal de Confirmação de Exclusão --}}
    @if($showDeleteModal)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl max-w-md mx-auto">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Confirmar Exclusão</h3>
            <p class="text-gray-600 mb-6">
                Tem certeza que deseja excluir este evento?
            </p>
            <div class="flex justify-end gap-3">
                <button
                    wire:click="cancelDelete"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition-colors"
                >
                    Cancelar
                </button>
                <button
                    wire:click="deleteEvent"
                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition-colors"
                >
                    Excluir
                </button>
            </div>
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let calendar;

        function initCalendar() {
            var calendarEl = document.getElementById('calendar');
            calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'pt-br',
                events: @json($events),
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                buttonText: {
                    today: 'Hoje',
                    month: 'Mês',
                    week: 'Semana',
                    day: 'Dia'
                },
                slotMinTime: '08:00:00',
                slotMaxTime: '18:00:00',
                allDaySlot: false,
                editable: true,
                eventClick: function(info) {
                    @this.confirmDelete(info.event.id);
                }
            });
            calendar.render();
        }

        initCalendar();

        // Atualiza o calendário quando eventos são modificados
        Livewire.on('refresh-calendar', () => {
            calendar.destroy();
            initCalendar();
        });
    });
</script>
@endpush
