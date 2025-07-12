<div>
    <!-- Debug: showModal = {{ $showModal ? 'true' : 'false' }} -->
    
    @if($showModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3 text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Confirmar Exclusão</h3>
                    <div class="mt-2 px-7 py-3">
                        <p class="text-sm text-gray-500">
                            Você tem certeza que deseja excluir o aluno <strong>{{ $studentName }}</strong>?
                        </p>
                        <p class="text-xs text-gray-400 mt-2">
                            Esta ação é irreversível e todos os dados associados ao aluno serão perdidos.
                        </p>
                    </div>
                    <div class="items-center px-4 py-3">
                        <div class="flex justify-end gap-x-3">
                            <button type="button" 
                                    class="px-4 py-2 bg-gray-300 text-gray-700 text-base font-medium rounded-md w-24 shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300"
                                    wire:click="$set('showModal', false)">
                                Cancelar
                            </button>
                            <button type="button" 
                                    class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md w-24 shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500"
                                    wire:click="deleteStudent">
                                Excluir
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>