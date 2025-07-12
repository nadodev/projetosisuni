@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Editar Aluno</h1>
        <a href="{{ route('admin.students.index') }}" class="btn btn-ghost">
            <i class="fas fa-arrow-left mr-2"></i> Voltar
        </a>
    </div>

    @if(session('error'))
        <div class="alert alert-error mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.students.update', $student) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-sm p-6">
        @csrf
        @method('PUT')

        <!-- 1. Identificação do Aluno -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">🧑‍🎓 Identificação do Aluno</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="label" for="full_name">Nome completo</label>
                    <input type="text" name="full_name" id="full_name" class="input input-bordered w-full" required value="{{ old('full_name', $student->full_name) }}">
                    @error('full_name') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="social_name">Nome social (se houver)</label>
                    <input type="text" name="social_name" id="social_name" class="input input-bordered w-full" value="{{ old('social_name', $student->social_name) }}">
                    @error('social_name') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="gender">Gênero</label>
                    <select name="gender" id="gender" class="select select-bordered w-full">
                        <option value="">Selecione...</option>
                        <option value="masculino" {{ old('gender', $student->gender) == 'masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="feminino" {{ old('gender', $student->gender) == 'feminino' ? 'selected' : '' }}>Feminino</option>
                        <option value="outro" {{ old('gender', $student->gender) == 'outro' ? 'selected' : '' }}>Outro</option>
                        <option value="prefiro_nao_dizer" {{ old('gender', $student->gender) == 'prefiro_nao_dizer' ? 'selected' : '' }}>Prefiro não dizer</option>
                    </select>
                    @error('gender') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="birth_date">Data de nascimento</label>
                    <input type="date" name="birth_date" id="birth_date" class="input input-bordered w-full" required value="{{ old('birth_date', $student->birth_date) }}">
                    @error('birth_date') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="cpf">CPF</label>
                    <input type="text" name="cpf" id="cpf" class="input input-bordered w-full" value="{{ old('cpf', $student->cpf) }}">
                    @error('cpf') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="school_code">Código interno da escola</label>
                    <input type="text" name="school_code" id="school_code" class="input input-bordered w-full" value="{{ old('school_code', $student->school_code) }}">
                    @error('school_code') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="registration_number">Registro escolar (RA/matrícula)</label>
                    <input type="text" name="registration_number" id="registration_number" class="input input-bordered w-full" required value="{{ old('registration_number', $student->registration_number) }}">
                    @error('registration_number') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- 2. Dados Escolares -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">🏫 Dados Escolares</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="label" for="grade_year">Série/Ano</label>
                    <input type="text" name="grade_year" id="grade_year" class="input input-bordered w-full" required value="{{ old('grade_year', $student->grade_year) }}">
                    @error('grade_year') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="class_id">Turma</label>
                    <select name="class_id" id="class_id" class="select select-bordered w-full" required>
                        <option value="">Selecione uma turma...</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ old('class_id', $student->class_id) == $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('class_id') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="shift">Turno</label>
                    <select name="shift" id="shift" class="select select-bordered w-full" required>
                        <option value="">Selecione...</option>
                        <option value="manha" {{ old('shift', $student->shift) == 'manha' ? 'selected' : '' }}>Manhã</option>
                        <option value="tarde" {{ old('shift', $student->shift) == 'tarde' ? 'selected' : '' }}>Tarde</option>
                        <option value="integral" {{ old('shift', $student->shift) == 'integral' ? 'selected' : '' }}>Integral</option>
                        <option value="noite" {{ old('shift', $student->shift) == 'noite' ? 'selected' : '' }}>Noite</option>
                    </select>
                    @error('shift') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="unit">Unidade (se for rede)</label>
                    <input type="text" name="unit" id="unit" class="input input-bordered w-full" value="{{ old('unit', $student->unit) }}">
                    @error('unit') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="teacher_id">Professor responsável</label>
                    <select name="teacher_id" id="teacher_id" class="select select-bordered w-full" required>
                        <option value="">Selecione um professor...</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('teacher_id', $student->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('teacher_id') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- 3. Perfil Neurodivergente -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">🧠 Perfil Neurodivergente</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="label">Tipo(s) de neurodivergência</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @php
                            $types = ['TEA', 'TDAH', 'Dislexia', 'Não informado'];
                            $oldTypes = old('neurodivergence_types', $student->neurodivergence_types ?? []);
                        @endphp
                        @foreach($types as $type)
                            <label class="flex items-center gap-2">
                                <input type="checkbox" 
                                       name="neurodivergence_types[]" 
                                       value="{{ $type }}"
                                       class="checkbox"
                                       {{ in_array($type, $oldTypes) ? 'checked' : '' }}>
                                <span>{{ $type }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('neurodivergence_types') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label">Diagnóstico oficial?</label>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2">
                            <input type="radio" name="has_official_diagnosis" value="1" class="radio" {{ old('has_official_diagnosis', $student->has_official_diagnosis) == '1' ? 'checked' : '' }}>
                            <span>Sim</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="has_official_diagnosis" value="0" class="radio" {{ old('has_official_diagnosis', $student->has_official_diagnosis) == '0' ? 'checked' : '' }}>
                            <span>Não</span>
                        </label>
                    </div>
                    @error('has_official_diagnosis') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-2">
                    <label class="label" for="pedagogical_observations">Observações pedagógicas iniciais</label>
                    <textarea name="pedagogical_observations" id="pedagogical_observations" rows="3" class="textarea textarea-bordered w-full">{{ old('pedagogical_observations', $student->pedagogical_observations) }}</textarea>
                    @error('pedagogical_observations') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-2">
                    <label class="label">Necessidades específicas</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @php
                            $needs = ['Leitura em voz alta', 'Fonte ampliada', 'Tempo extra'];
                            $oldNeeds = old('specific_needs', $student->specific_needs ?? []);
                        @endphp
                        @foreach($needs as $need)
                            <label class="flex items-center gap-2">
                                <input type="checkbox" 
                                       name="specific_needs[]" 
                                       value="{{ $need }}"
                                       class="checkbox"
                                       {{ in_array($need, $oldNeeds) ? 'checked' : '' }}>
                                <span>{{ $need }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('specific_needs') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="learning_style">Estilo de aprendizagem preferido</label>
                    <select name="learning_style" id="learning_style" class="select select-bordered w-full">
                        <option value="">Selecione...</option>
                        <option value="visual" {{ old('learning_style', $student->learning_style) == 'visual' ? 'selected' : '' }}>Visual</option>
                        <option value="auditivo" {{ old('learning_style', $student->learning_style) == 'auditivo' ? 'selected' : '' }}>Auditivo</option>
                        <option value="cinestesico" {{ old('learning_style', $student->learning_style) == 'cinestesico' ? 'selected' : '' }}>Cinestésico</option>
                        <option value="misto" {{ old('learning_style', $student->learning_style) == 'misto' ? 'selected' : '' }}>Misto</option>
                    </select>
                    @error('learning_style') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="sensitivities">Sensibilidades</label>
                    <input type="text" name="sensitivities" id="sensitivities" class="input input-bordered w-full" value="{{ old('sensitivities', $student->sensitivities) }}">
                    @error('sensitivities') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- 4. Responsável -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">👨‍👩‍👧‍👦 Responsável Principal</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="label" for="guardian_name">Nome do responsável</label>
                    <input type="text" name="guardian_name" id="guardian_name" class="input input-bordered w-full" required value="{{ old('guardian_name', $student->guardian_name) }}">
                    @error('guardian_name') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="guardian_kinship">Grau de parentesco</label>
                    <select name="guardian_kinship" id="guardian_kinship" class="select select-bordered w-full" required>
                        <option value="">Selecione...</option>
                        <option value="pai" {{ old('guardian_kinship', $student->guardian_kinship) == 'pai' ? 'selected' : '' }}>Pai</option>
                        <option value="mae" {{ old('guardian_kinship', $student->guardian_kinship) == 'mae' ? 'selected' : '' }}>Mãe</option>
                        <option value="tutor" {{ old('guardian_kinship', $student->guardian_kinship) == 'tutor' ? 'selected' : '' }}>Tutor</option>
                        <option value="outro" {{ old('guardian_kinship', $student->guardian_kinship) == 'outro' ? 'selected' : '' }}>Outro</option>
                    </select>
                    @error('guardian_kinship') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="guardian_cpf">CPF do responsável</label>
                    <input type="text" name="guardian_cpf" id="guardian_cpf" class="input input-bordered w-full" required value="{{ old('guardian_cpf', $student->guardian_cpf) }}">
                    @error('guardian_cpf') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="guardian_email">E-mail</label>
                    <input type="email" name="guardian_email" id="guardian_email" class="input input-bordered w-full" required value="{{ old('guardian_email', $student->guardian_email) }}">
                    @error('guardian_email') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="guardian_phone">Telefone/WhatsApp</label>
                    <input type="text" name="guardian_phone" id="guardian_phone" class="input input-bordered w-full" required value="{{ old('guardian_phone', $student->guardian_phone) }}">
                    @error('guardian_phone') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-6">
                <h3 class="text-md font-medium text-gray-700 mb-4">Responsável Secundário (opcional)</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="label" for="secondary_guardian_name">Nome do responsável</label>
                        <input type="text" name="secondary_guardian_name" id="secondary_guardian_name" class="input input-bordered w-full" value="{{ old('secondary_guardian_name', $student->secondary_guardian_name) }}">
                        @error('secondary_guardian_name') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="label" for="secondary_guardian_kinship">Grau de parentesco</label>
                        <select name="secondary_guardian_kinship" id="secondary_guardian_kinship" class="select select-bordered w-full">
                            <option value="">Selecione...</option>
                            <option value="pai" {{ old('secondary_guardian_kinship', $student->secondary_guardian_kinship) == 'pai' ? 'selected' : '' }}>Pai</option>
                            <option value="mae" {{ old('secondary_guardian_kinship', $student->secondary_guardian_kinship) == 'mae' ? 'selected' : '' }}>Mãe</option>
                            <option value="tutor" {{ old('secondary_guardian_kinship', $student->secondary_guardian_kinship) == 'tutor' ? 'selected' : '' }}>Tutor</option>
                            <option value="outro" {{ old('secondary_guardian_kinship', $student->secondary_guardian_kinship) == 'outro' ? 'selected' : '' }}>Outro</option>
                        </select>
                        @error('secondary_guardian_kinship') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="label" for="secondary_guardian_cpf">CPF do responsável</label>
                        <input type="text" name="secondary_guardian_cpf" id="secondary_guardian_cpf" class="input input-bordered w-full" value="{{ old('secondary_guardian_cpf', $student->secondary_guardian_cpf) }}">
                        @error('secondary_guardian_cpf') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="label" for="secondary_guardian_email">E-mail</label>
                        <input type="email" name="secondary_guardian_email" id="secondary_guardian_email" class="input input-bordered w-full" value="{{ old('secondary_guardian_email', $student->secondary_guardian_email) }}">
                        @error('secondary_guardian_email') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="label" for="secondary_guardian_phone">Telefone/WhatsApp</label>
                        <input type="text" name="secondary_guardian_phone" id="secondary_guardian_phone" class="input input-bordered w-full" value="{{ old('secondary_guardian_phone', $student->secondary_guardian_phone) }}">
                        @error('secondary_guardian_phone') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- 5. Sistema -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">⚙️ Configurações do Sistema</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="label" for="status">Situação do cadastro</label>
                    <select name="status" id="status" class="select select-bordered w-full" required>
                        <option value="ativo" {{ old('status', $student->status) == 'ativo' ? 'selected' : '' }}>Ativo</option>
                        <option value="inativo" {{ old('status', $student->status) == 'inativo' ? 'selected' : '' }}>Inativo</option>
                    </select>
                    @error('status') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="flex items-center gap-2">
                        <input type="checkbox" 
                               name="guardian_panel_access" 
                               value="1"
                               class="checkbox"
                               {{ old('guardian_panel_access', $student->guardian_panel_access) ? 'checked' : '' }}>
                        <span>Liberar acesso ao painel dos responsáveis?</span>
                    </label>
                    @error('guardian_panel_access') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- 6. Extras -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">📎 Extras</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="label" for="photo">Foto do aluno</label>
                    @if($student->photo_path)
                        <div class="mb-2">
                            <img src="{{ Storage::url($student->photo_path) }}" 
                                 alt="Foto atual do aluno" 
                                 class="w-32 h-32 object-cover rounded">
                        </div>
                    @endif
                    <input type="file" name="photo" id="photo" class="file-input file-input-bordered w-full" accept="image/*">
                    @error('photo') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="evaluation_file">Arquivo de avaliação ou laudo (PDF)</label>
                    @if($student->evaluation_file_path)
                        <div class="mb-2">
                            <a href="{{ Storage::url($student->evaluation_file_path) }}" 
                               target="_blank"
                               class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-file-pdf mr-2"></i>Ver arquivo atual
                            </a>
                        </div>
                    @endif
                    <input type="file" name="evaluation_file" id="evaluation_file" class="file-input file-input-bordered w-full" accept=".pdf">
                    @error('evaluation_file') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="external_support_name">Nome do terapeuta/apoio externo</label>
                    <input type="text" name="external_support_name" id="external_support_name" class="input input-bordered w-full" value="{{ old('external_support_name', $student->external_support_name) }}">
                    @error('external_support_name') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-2"></i> Salvar Alterações
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Adicionar máscaras e validações de formulário aqui
    document.addEventListener('DOMContentLoaded', function() {
        // Máscara para CPF
        const cpfInputs = document.querySelectorAll('#cpf, #guardian_cpf, #secondary_guardian_cpf');
        cpfInputs.forEach(input => {
            input.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length <= 11) {
                    value = value.replace(/(\d{3})(\d)/, '$1.$2');
                    value = value.replace(/(\d{3})(\d)/, '$1.$2');
                    value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                }
                e.target.value = value;
            });
        });

        // Máscara para telefone
        const phoneInputs = document.querySelectorAll('#guardian_phone, #secondary_guardian_phone');
        phoneInputs.forEach(input => {
            input.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length <= 11) {
                    value = value.replace(/(\d{2})(\d)/, '($1) $2');
                    value = value.replace(/(\d{4,5})(\d{4})$/, '$1-$2');
                }
                e.target.value = value;
            });
        });
    });
</script>
@endpush

@endsection 