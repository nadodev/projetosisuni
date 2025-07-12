<div x-data="{ open: {{ session('needs_institution_update') ? 'true' : 'false' }} }"
     x-show="open"
     class="overflow-y-auto fixed inset-0 z-50"
     style="display: none;">
    <div class="flex justify-center items-center px-4 pt-4 pb-20 min-h-screen text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <div class="inline-block overflow-hidden text-left align-bottom bg-white rounded-lg shadow-xl transition-all transform sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="{{ route('profile.update-institution') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 w-full text-center sm:mt-0 sm:text-left">
                            <h3 class="mb-4 text-lg font-medium leading-6 text-gray-900">
                                Atualizar Instituição
                            </h3>

                            <div class="mb-4">
                                <label for="institution_id" class="block text-sm font-medium text-gray-700">
                                    Selecione sua Instituição
                                </label>
                                <select name="institution_id" id="institution_id" required
                                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Selecione...</option>
                                    @foreach(\App\Models\Instituicao::all() as $instituicao)
                                        <option value="{{ $instituicao->id }}">
                                            {{ $instituicao->nome }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('institution_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit"
                        class="inline-flex justify-center px-4 py-2 w-full text-base font-medium text-white bg-blue-600 rounded-md border border-transparent shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
