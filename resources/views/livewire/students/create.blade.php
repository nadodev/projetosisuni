<div>
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Cadastrar Novo Aluno</h2>
            <a href="{{ route('students.index') }}" class="btn btn-ghost">
                <i class="fas fa-arrow-left mr-2"></i> Voltar
            </a>
        </div>

        <form wire:submit="save" class="bg-white rounded-lg shadow-sm p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Dados Pessoais -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-gray-900">Dados Pessoais</h3>
                    
                    <div>
                        <label class="label">Nome</label>
                        <input type="text" wire:model="name" class="input input-bordered w-full @error('name') input-error @enderror">
                        @error('name') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="label">Data de Nascimento</label>
                        <input type="date" wire:model="birth_date" class="input input-bordered w-full @error('birth_date') input-error @enderror">
                        @error('birth_date') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="label">Neurodivergência</label>
                        <input type="text" wire:model="neurodivergence" class="input input-bordered w-full @error('neurodivergence') input-error @enderror">
                        @error('neurodivergence') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="label">Observações</label>
                        <textarea wire:model="notes" class="textarea textarea-bordered w-full @error('notes') textarea-error @enderror" rows="3"></textarea>
                        @error('notes') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Vínculos e Preferências -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-gray-900">Vínculos e Preferências</h3>

                    <div>
                        <label class="label">Responsável</label>
                        <select wire:model="responsible_id" class="select select-bordered w-full @error('responsible_id') select-error @enderror">
                            <option value="">Selecione um responsável</option>
                            @foreach($responsibles as $responsible)
                                <option value="{{ $responsible->id }}">{{ $responsible->name }}</option>
                            @endforeach
                        </select>
                        @error('responsible_id') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="label">Turma</label>
                        <select wire:model="class_id" class="select select-bordered w-full @error('class_id') select-error @enderror">
                            <option value="">Selecione uma turma</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                        @error('class_id') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="label">Preferências de Aprendizado</label>
                        <div class="space-y-2">
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" wire:model="learning_preferences" value="visual" class="checkbox">
                                <span>Visual</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" wire:model="learning_preferences" value="auditivo" class="checkbox">
                                <span>Auditivo</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" wire:model="learning_preferences" value="cinestesico" class="checkbox">
                                <span>Cinestésico</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i> Salvar
                </button>
            </div>
        </form>
    </div>
</div> 