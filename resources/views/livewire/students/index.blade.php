<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Alunos</h2>
        <a href="{{ route('students.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i> Cadastrar Novo Aluno
        </a>
    </div>

    <!-- Filtros -->
    <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="label">Buscar</label>
                <input type="text" wire:model.live.debounce.300ms="search" class="input input-bordered w-full" placeholder="Nome do aluno...">
            </div>
            <div>
                <label class="label">Turma</label>
                <select wire:model.live="class" class="select select-bordered w-full">
                    <option value="">Todas as turmas</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="label">Neurodivergência</label>
                <select wire:model.live="neurodivergence" class="select select-bordered w-full">
                    <option value="">Todas</option>
                    @foreach($neurodivergences as $neuro)
                        <option value="{{ $neuro }}">{{ $neuro }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Lista de Alunos -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Idade</th>
                        <th>Neurodivergência</th>
                        <th>Turma</th>
                        <th>Responsável</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->age }} anos</td>
                            <td>{{ $student->neurodivergence ?? '-' }}</td>
                            <td>{{ $student->class->name }}</td>
                            <td>{{ $student->responsible->name }}</td>
                            <td>
                                <div class="flex space-x-2">
                                    <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-ghost">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-ghost">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                Nenhum aluno encontrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $students->links() }}
        </div>
    </div>
</div> 