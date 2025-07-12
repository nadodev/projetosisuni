@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detalhes do Aluno</h1>
        <div class="flex gap-2">
            <button type="button"
                    onclick="Livewire.emit('openModal', 'students.educational-profile', {{ json_encode(['student' => $student->id]) }})"
                    class="btn btn-primary">
                <i class="fas fa-brain mr-2"></i> Perfil Educacional
            </button>
            <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-warning">
                <i class="fas fa-edit mr-2"></i> Editar
            </a>
            <a href="{{ route('admin.students.index') }}" class="btn btn-ghost">
                <i class="fas fa-arrow-left mr-2"></i> Voltar
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Coluna da Esquerda -->
        <div class="lg:col-span-2 space-y-6">
            <!-- 1. Identificação do Aluno -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">🧑‍🎓 Identificação do Aluno</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-600">Nome completo</label>
                        <p class="text-gray-800 font-medium">{{ $student->full_name }}</p>
                    </div>

                    @if($student->social_name)
                    <div>
                        <label class="text-sm text-gray-600">Nome social</label>
                        <p class="text-gray-800 font-medium">{{ $student->social_name }}</p>
                    </div>
                    @endif

                    @if($student->gender)
                    <div>
                        <label class="text-sm text-gray-600">Gênero</label>
                        <p class="text-gray-800 font-medium">{{ ucfirst($student->gender) }}</p>
                    </div>
                    @endif

                    <div>
                        <label class="text-sm text-gray-600">Data de nascimento</label>
                        <p class="text-gray-800 font-medium">{{ \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y') }}</p>
                    </div>

                    @if($student->cpf)
                    <div>
                        <label class="text-sm text-gray-600">CPF</label>
                        <p class="text-gray-800 font-medium">{{ $student->cpf }}</p>
                    </div>
                    @endif

                    @if($student->school_code)
                    <div>
                        <label class="text-sm text-gray-600">Código interno</label>
                        <p class="text-gray-800 font-medium">{{ $student->school_code }}</p>
                    </div>
                    @endif

                    <div>
                        <label class="text-sm text-gray-600">Registro escolar</label>
                        <p class="text-gray-800 font-medium">{{ $student->registration_number }}</p>
                    </div>
                </div>
            </div>

            <!-- 2. Dados Escolares -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">🏫 Dados Escolares</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-600">Série/Ano</label>
                        <p class="text-gray-800 font-medium">{{ $student->grade_year }}</p>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Turma</label>
                        <p class="text-gray-800 font-medium">{{ $student->class->name }}</p>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Turno</label>
                        <p class="text-gray-800 font-medium">{{ ucfirst($student->shift) }}</p>
                    </div>

                    @if($student->unit)
                    <div>
                        <label class="text-sm text-gray-600">Unidade</label>
                        <p class="text-gray-800 font-medium">{{ $student->unit }}</p>
                    </div>
                    @endif

                    <div>
                        <label class="text-sm text-gray-600">Professor responsável</label>
                        <p class="text-gray-800 font-medium">{{ $student->teacher->name }}</p>
                    </div>
                </div>
            </div>

            <!-- 3. Perfil Neurodivergente -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">🧠 Perfil Neurodivergente</h2>
                <div class="space-y-4">
                    <div>
                        <label class="text-sm text-gray-600">Tipo(s) de neurodivergência</label>
                        <div class="flex flex-wrap gap-2 mt-1">
                            @foreach($student->neurodivergence_types as $type)
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                    {{ $type }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    @if($student->has_official_diagnosis !== null)
                    <div>
                        <label class="text-sm text-gray-600">Diagnóstico oficial?</label>
                        <p class="text-gray-800 font-medium">{{ $student->has_official_diagnosis ? 'Sim' : 'Não' }}</p>
                    </div>
                    @endif

                    @if($student->pedagogical_observations)
                    <div>
                        <label class="text-sm text-gray-600">Observações pedagógicas</label>
                        <p class="text-gray-800 font-medium whitespace-pre-line">{{ $student->pedagogical_observations }}</p>
                    </div>
                    @endif

                    @if($student->specific_needs)
                    <div>
                        <label class="text-sm text-gray-600">Necessidades específicas</label>
                        <div class="flex flex-wrap gap-2 mt-1">
                            @foreach($student->specific_needs as $need)
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">
                                    {{ $need }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($student->learning_style)
                    <div>
                        <label class="text-sm text-gray-600">Estilo de aprendizagem</label>
                        <p class="text-gray-800 font-medium">{{ ucfirst($student->learning_style) }}</p>
                    </div>
                    @endif

                    @if($student->sensitivities)
                    <div>
                        <label class="text-sm text-gray-600">Sensibilidades</label>
                        <p class="text-gray-800 font-medium">{{ $student->sensitivities }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Coluna da Direita -->
        <div class="space-y-6">
            <!-- Status e Foto -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex flex-col items-center">
                    @if($student->photo_path)
                        <img src="{{ Storage::url($student->photo_path) }}" 
                             alt="Foto de {{ $student->full_name }}"
                             class="w-32 h-32 rounded-full object-cover mb-4">
                    @else
                        <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center mb-4">
                            <i class="fas fa-user text-gray-400 text-4xl"></i>
                        </div>
                    @endif

                    <span class="px-3 py-1 rounded-full text-sm font-semibold 
                        {{ $student->status === 'ativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($student->status) }}
                    </span>

                    @if($student->guardian_panel_access)
                        <span class="mt-2 px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                            Acesso ao painel liberado
                        </span>
                    @endif
                </div>
            </div>

            <!-- Responsável Principal -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">👨‍👩‍👧‍👦 Responsável Principal</h2>
                <div class="space-y-3">
                    <div>
                        <label class="text-sm text-gray-600">Nome</label>
                        <p class="text-gray-800 font-medium">{{ $student->guardian_name }}</p>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Parentesco</label>
                        <p class="text-gray-800 font-medium">{{ ucfirst($student->guardian_kinship) }}</p>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">CPF</label>
                        <p class="text-gray-800 font-medium">{{ $student->guardian_cpf }}</p>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">E-mail</label>
                        <p class="text-gray-800 font-medium">{{ $student->guardian_email }}</p>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Telefone</label>
                        <p class="text-gray-800 font-medium">{{ $student->guardian_phone }}</p>
                    </div>
                </div>
            </div>

            <!-- Responsável Secundário -->
            @if($student->secondary_guardian_name)
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">👨‍👩‍👧‍👦 Responsável Secundário</h2>
                <div class="space-y-3">
                    <div>
                        <label class="text-sm text-gray-600">Nome</label>
                        <p class="text-gray-800 font-medium">{{ $student->secondary_guardian_name }}</p>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Parentesco</label>
                        <p class="text-gray-800 font-medium">{{ ucfirst($student->secondary_guardian_kinship) }}</p>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">CPF</label>
                        <p class="text-gray-800 font-medium">{{ $student->secondary_guardian_cpf }}</p>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">E-mail</label>
                        <p class="text-gray-800 font-medium">{{ $student->secondary_guardian_email }}</p>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Telefone</label>
                        <p class="text-gray-800 font-medium">{{ $student->secondary_guardian_phone }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Extras -->
            @if($student->evaluation_file_path || $student->external_support_name)
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">📎 Extras</h2>
                <div class="space-y-3">
                    @if($student->evaluation_file_path)
                    <div>
                        <label class="text-sm text-gray-600">Laudo/Avaliação</label>
                        <div class="mt-1">
                            <a href="{{ Storage::url($student->evaluation_file_path) }}" 
                               target="_blank"
                               class="text-blue-600 hover:text-blue-800 flex items-center gap-2">
                                <i class="fas fa-file-pdf"></i>
                                <span>Visualizar arquivo</span>
                            </a>
                        </div>
                    </div>
                    @endif

                    @if($student->external_support_name)
                    <div>
                        <label class="text-sm text-gray-600">Apoio externo</label>
                        <p class="text-gray-800 font-medium">{{ $student->external_support_name }}</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection 