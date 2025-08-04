@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Cadastrar Novo Aluno</h1>
        <a href="{{ route('admin.students.index') }}" class="btn btn-ghost">
            <i class="fas fa-arrow-left mr-2"></i> Voltar
        </a>
    </div>
    @if($errors->any())
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <strong>Erro!</strong> Por favor, corrija os seguintes erros:
            <ul class="mt-2 list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-sm p-6">
        @csrf

        <!-- 1. Identificação do Aluno -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">🧑‍🎓 Identificação do Aluno</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="label text-gray-500" for="full_name">Nome completo</label>
                    <input type="text" name="full_name" id="full_name" 
                           class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('full_name') ? 'input-error' : '' }}" 
                           required value="{{ old('full_name') }}">
                    @error('full_name') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>

                <div>
                    <label class="label text-gray-500" for="social_name">Nome social (se houver)</label>
                    <input type="text" name="social_name" id="social_name" 
                           class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('social_name') ? 'input-error' : '' }}" 
                           value="{{ old('social_name') }}">
                    @error('social_name') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>

                <div>
                    <label class="label text-gray-500" for="gender">Gênero</label>
                    <select name="gender" id="gender" 
                            class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('gender') ? 'select-error' : '' }}">
                        <option value="">Selecione...</option>
                        <option value="masculino" {{ old('gender') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="feminino" {{ old('gender') == 'feminino' ? 'selected' : '' }}>Feminino</option>
                        <option value="outro" {{ old('gender') == 'outro' ? 'selected' : '' }}>Outro</option>
                        <option value="prefiro_nao_dizer" {{ old('gender') == 'prefiro_nao_dizer' ? 'selected' : '' }}>Prefiro não dizer</option>
                    </select>
                    @error('gender') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>

                <div>
                    <label class="label text-gray-500" for="birth_date">Data de nascimento</label>
                    <input type="date" name="birth_date" id="birth_date" 
                           class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('birth_date') ? 'input-error' : '' }}" 
                           required value="{{ old('birth_date') }}">
                    @error('birth_date') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>

                <div>
                    <label class="label text-gray-500" for="cpf">CPF</label>
                    <input type="text" name="cpf" id="cpf" 
                           class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('cpf') ? 'input-error' : '' }}" 
                           required value="{{ old('cpf') }}">
                    @error('cpf') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>

                <div>
                    <label class="label text-gray-500" for="school_code">Código interno da escola</label>
                    <input type="text" name="school_code" id="school_code" 
                           class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('school_code') ? 'input-error' : '' }}" 
                           value="{{ old('school_code') }}">
                    @error('school_code') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>

                <div>
                    <label class="label text-gray-500" for="registration_number">Registro escolar (RA/matrícula)</label>
                    <input type="text" name="registration_number" id="registration_number" 
                           class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('registration_number') ? 'input-error' : '' }}" 
                           required value="{{ old('registration_number') }}">
                    @error('registration_number') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>
            </div>
        </div>

        <!-- 2. Dados Escolares -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">🏫 Dados Escolares</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="label text-gray-500" for="grade_year">Série/Ano</label>
                    <input type="text" name="grade_year" id="grade_year" 
                           class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('grade_year') ? 'input-error' : '' }}" 
                           required value="{{ old('grade_year') }}">
                    @error('grade_year') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>

                <div>
                    <label class="label text-gray-500" for="class_id">Turma</label>
                    <select name="class_id" id="class_id" 
                            class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('class_id') ? 'select-error' : '' }}" 
                            required>
                        <option value="">Selecione uma turma...</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}
                                {{ $class->students->count() >= $class->capacidade ? 'disabled' : '' }}>
                                {{ $class->nome }} ({{ $class->serie }}) - 
                                {{ $class->students->count() }}/{{ $class->capacidade }} vagas - 
                                {{ ucfirst($class->turno) }} - 
                                Prof. {{ $class->teacher ? $class->teacher->name : 'Não definido' }}
                            </option>
                        @endforeach
                    </select>
                    @error('class_id') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>

                <div>
                    <label class="label text-gray-500" for="shift">Turno</label>
                    <select name="shift" id="shift" 
                            class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('shift') ? 'select-error' : '' }}" 
                            required>
                        <option value="">Selecione...</option>
                        <option value="manha" {{ old('shift') == 'manha' ? 'selected' : '' }}>Manhã</option>
                        <option value="tarde" {{ old('shift') == 'tarde' ? 'selected' : '' }}>Tarde</option>
                        <option value="integral" {{ old('shift') == 'integral' ? 'selected' : '' }}>Integral</option>
                        <option value="noite" {{ old('shift') == 'noite' ? 'selected' : '' }}>Noite</option>
                    </select>
                    @error('shift') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>

                <div>
                    <label class="label text-gray-500" for="unit">Unidade (se for rede)</label>
                    <input type="text" name="unit" id="unit" 
                           class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('unit') ? 'input-error' : '' }}" 
                           value="{{ old('unit') }}">
                    @error('unit') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>

                <div>
                    <label class="label text-gray-500" for="teacher_id">Professor responsável</label>
                    <select name="teacher_id" id="teacher_id" 
                            class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('teacher_id') ? 'select-error' : '' }}" 
                            required>
                        <option value="">Selecione um professor...</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('teacher_id') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>
            </div>
        </div>

        <!-- 3. Perfil Neurodivergente -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">🧠 Perfil Neurodivergente</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="label text-gray-500">Tipo(s) de neurodivergência <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @php
                            $types = ['TEA', 'TDAH', 'Dislexia', 'Não informado'];
                            $oldTypes = old('neurodivergence_types', ['Não informado']);
                        @endphp
                        @foreach($types as $type)
                            <label class="flex items-center gap-2 text-gray-500">
                                <input type="checkbox" 
                                       name="neurodivergence_types[]" 
                                       value="{{ $type }}"
                                       class=" border-gray-500"
                                       {{ in_array($type, $oldTypes) ? 'checked' : '' }}>
                                <span>{{ $type }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('neurodivergence_types') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>

                <div>
                    <label class="label text-gray-500">Diagnóstico oficial?</label>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2">
                            <input type="radio" name="has_official_diagnosis" value="1" class="" {{ old('has_official_diagnosis') == '1' ? 'checked' : '' }}>
                            <span class="text-gray-500">Sim</span>
                        </label>
                        <label class="flex items-center gap-2 text-gray-500">
                            <input type="radio" name="has_official_diagnosis" value="0" class="" {{ old('has_official_diagnosis') == '0' ? 'checked' : (old('has_official_diagnosis') === null ? 'checked' : '') }}>
                            <span class="text-gray-500">Não</span>
                        </label>
                    </div>
                    @error('has_official_diagnosis') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>

                <div class="col-span-2">
                    <label class="label text-gray-500" for="pedagogical_observations">Observações pedagógicas iniciais</label>
                    <textarea name="pedagogical_observations" id="pedagogical_observations" rows="3" 
                              class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('pedagogical_observations') ? 'textarea-error' : '' }}">{{ old('pedagogical_observations') }}</textarea>
                    @error('pedagogical_observations') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>

                <div class="col-span-2">
                    <label class="label text-gray-500">Necessidades específicas</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @php
                            $needs = ['Leitura em voz alta', 'Fonte ampliada', 'Tempo extra'];
                            $oldNeeds = old('specific_needs', []);
                        @endphp
                        @foreach($needs as $need)
                            <label class="flex items-center gap-2">
                                <input type="checkbox" 
                                       name="specific_needs[]" 
                                       value="{{ $need }}"
                                       class=""
                                       {{ in_array($need, $oldNeeds) ? 'checked' : '' }}>
                                <span class="text-gray-500">{{ $need }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('specific_needs') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>

                <div>
                    <label class="label text-gray-500" for="learning_style">Estilo de aprendizagem preferido</label>
                    <select name="learning_style" id="learning_style" 
                            class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('learning_style') ? 'select-error' : '' }}">
                        <option value="">Selecione...</option>
                        <option value="visual" {{ old('learning_style') == 'visual' ? 'selected' : '' }}>Visual</option>
                        <option value="auditivo" {{ old('learning_style') == 'auditivo' ? 'selected' : '' }}>Auditivo</option>
                        <option value="cinestesico" {{ old('learning_style') == 'cinestesico' ? 'selected' : '' }}>Cinestésico</option>
                        <option value="misto" {{ old('learning_style') == 'misto' ? 'selected' : '' }}>Misto</option>
                    </select>
                    @error('learning_style') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>

                <div>
                    <label class="label text-gray-500" for="sensitivities">Sensibilidades</label>
                    <input type="text" name="sensitivities" id="sensitivities" 
                           class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('sensitivities') ? 'input-error' : '' }}" 
                           value="{{ old('sensitivities') }}">
                    @error('sensitivities') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>
            </div>
        </div>

        <!-- 4. Responsável -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">👨‍👩‍👧‍👦 Responsável Principal</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="label text-gray-500" for="guardian_name">Nome do responsável</label>
                    <input type="text" name="guardian_name" id="guardian_name" 
                           class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('guardian_name') ? 'input-error' : '' }}" 
                           required value="{{ old('guardian_name') }}">
                    @error('guardian_name') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>

                <div>
                    <label class="label text-gray-500" for="guardian_kinship">Grau de parentesco</label>
                    <select name="guardian_kinship" id="guardian_kinship" 
                            class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('guardian_kinship') ? 'select-error' : '' }}" 
                            required>
                        <option value="">Selecione...</option>
                        <option value="pai" {{ old('guardian_kinship') == 'pai' ? 'selected' : '' }}>Pai</option>
                        <option value="mae" {{ old('guardian_kinship') == 'mae' ? 'selected' : '' }}>Mãe</option>
                        <option value="tutor" {{ old('guardian_kinship') == 'tutor' ? 'selected' : '' }}>Tutor</option>
                        <option value="outro" {{ old('guardian_kinship') == 'outro' ? 'selected' : '' }}>Outro</option>
                    </select>
                    @error('guardian_kinship') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>

                <div>
                    <label class="label text-gray-500" for="guardian_cpf">CPF do responsável</label>
                    <input type="text" name="guardian_cpf" id="guardian_cpf" 
                           class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('guardian_cpf') ? 'input-error' : '' }}" 
                           required value="{{ old('guardian_cpf') }}">
                    @error('guardian_cpf') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>

                <div>
                    <label class="label text-gray-500" for="guardian_email">E-mail</label>
                    <input type="email" name="guardian_email" id="guardian_email" 
                           class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('guardian_email') ? 'input-error' : '' }}" 
                           required value="{{ old('guardian_email') }}">
                    @error('guardian_email') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>

                <div>
                    <label class="label text-gray-500" for="guardian_phone">Telefone/WhatsApp</label>
                    <input type="text" name="guardian_phone" id="guardian_phone" 
                           class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('guardian_phone') ? 'input-error' : '' }}" 
                           required value="{{ old('guardian_phone') }}">
                    @error('guardian_phone') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>

                <!-- Endereço do Responsável -->
                <div class="col-span-2">
                    <h3 class="text-md font-medium text-gray-700 mb-4">Endereço do Responsável</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="label text-gray-500" for="guardian_cep">CEP</label>
                            <input type="text" name="guardian_cep" id="guardian_cep" 
                                   class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('guardian_cep') ? 'input-error' : '' }}" 
                                   required value="{{ old('guardian_cep') }}">
                            @error('guardian_cep') 
                                <span class="text-error text-sm mt-1 block">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </span> 
                            @enderror
                        </div>

                        <div>
                            <label class="label text-gray-500" for="guardian_endereco">Endereço</label>
                            <input type="text" name="guardian_endereco" id="guardian_endereco" 
                                   class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('guardian_endereco') ? 'input-error' : '' }}" 
                                   required value="{{ old('guardian_endereco') }}">
                            @error('guardian_endereco') 
                                <span class="text-error text-sm mt-1 block">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </span> 
                            @enderror
                        </div>

                        <div>
                            <label class="label text-gray-500" for="guardian_bairro">Bairro</label>
                            <input type="text" name="guardian_bairro" id="guardian_bairro" 
                                   class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('guardian_bairro') ? 'input-error' : '' }}" 
                                   required value="{{ old('guardian_bairro') }}">
                            @error('guardian_bairro') 
                                <span class="text-error text-sm mt-1 block">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </span> 
                            @enderror
                        </div>

                        <div>
                            <label class="label text-gray-500" for="guardian_cidade">Cidade</label>
                            <input type="text" name="guardian_cidade" id="guardian_cidade" 
                                   class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('guardian_cidade') ? 'input-error' : '' }}" 
                                   required value="{{ old('guardian_cidade') }}">
                            @error('guardian_cidade') 
                                <span class="text-error text-sm mt-1 block">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </span> 
                            @enderror
                        </div>

                        <div>
                            <label class="label text-gray-500" for="guardian_uf">UF</label>
                            <select name="guardian_uf" id="guardian_uf" 
                                    class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('guardian_uf') ? 'select-error' : '' }}" 
                                    required>
                                <option value="">Selecione...</option>
                                @foreach(['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'] as $uf)
                                    <option value="{{ $uf }}" {{ old('guardian_uf') == $uf ? 'selected' : '' }}>{{ $uf }}</option>
                                @endforeach
                            </select>
                            @error('guardian_uf') 
                                <span class="text-error text-sm mt-1 block">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </span> 
                            @enderror
                        </div>

                        <div>
                            <label class="label text-gray-500" for="guardian_numero">Número</label>
                            <input type="text" name="guardian_numero" id="guardian_numero" 
                                   class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('guardian_numero') ? 'input-error' : '' }}" 
                                   required value="{{ old('guardian_numero') }}">
                            @error('guardian_numero') 
                                <span class="text-error text-sm mt-1 block">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </span> 
                            @enderror
                        </div>

                        <div>
                            <label class="label text-gray-500" for="guardian_complemento">Complemento</label>
                            <input type="text" name="guardian_complemento" id="guardian_complemento" 
                                   class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('guardian_complemento') ? 'input-error' : '' }}" 
                                   value="{{ old('guardian_complemento') }}">
                            @error('guardian_complemento') 
                                <span class="text-error text-sm mt-1 block">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </span> 
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <h3 class="text-md font-medium text-gray-700 mb-4">Responsável Secundário (opcional)</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="label text-gray-500" for="secondary_guardian_name">Nome do responsável</label>
                        <input type="text" name="secondary_guardian_name" id="secondary_guardian_name" 
                               class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('secondary_guardian_name') ? 'input-error' : '' }}" 
                               value="{{ old('secondary_guardian_name') }}">
                        @error('secondary_guardian_name') 
                            <span class="text-error text-sm mt-1 block">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </span> 
                        @enderror
                    </div>

                    <div>
                        <label class="label text-gray-500" for="secondary_guardian_kinship">Grau de parentesco</label>
                        <select name="secondary_guardian_kinship" id="secondary_guardian_kinship" 
                                class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('secondary_guardian_kinship') ? 'select-error' : '' }}">
                            <option value="">Selecione...</option>
                            <option value="pai" {{ old('secondary_guardian_kinship') == 'pai' ? 'selected' : '' }}>Pai</option>
                            <option value="mae" {{ old('secondary_guardian_kinship') == 'mae' ? 'selected' : '' }}>Mãe</option>
                            <option value="tutor" {{ old('secondary_guardian_kinship') == 'tutor' ? 'selected' : '' }}>Tutor</option>
                            <option value="outro" {{ old('secondary_guardian_kinship') == 'outro' ? 'selected' : '' }}>Outro</option>
                        </select>
                        @error('secondary_guardian_kinship') 
                            <span class="text-error text-sm mt-1 block">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </span> 
                        @enderror
                    </div>

                    <div>
                        <label class="label text-gray-500" for="secondary_guardian_cpf">CPF do responsável</label>
                        <input type="text" name="secondary_guardian_cpf" id="secondary_guardian_cpf" 
                               class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('secondary_guardian_cpf') ? 'input-error' : '' }}" 
                               value="{{ old('secondary_guardian_cpf') }}">
                        @error('secondary_guardian_cpf') 
                            <span class="text-error text-sm mt-1 block">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </span> 
                        @enderror
                    </div>

                    <div>
                        <label class="label text-gray-500" for="secondary_guardian_email">E-mail</label>
                        <input type="email" name="secondary_guardian_email" id="secondary_guardian_email" 
                               class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('secondary_guardian_email') ? 'input-error' : '' }}" 
                               value="{{ old('secondary_guardian_email') }}">
                        @error('secondary_guardian_email') 
                            <span class="text-error text-sm mt-1 block">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </span> 
                        @enderror
                    </div>

                    <div>
                        <label class="label text-gray-500" for="secondary_guardian_phone">Telefone/WhatsApp</label>
                        <input type="text" name="secondary_guardian_phone" id="secondary_guardian_phone" 
                               class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('secondary_guardian_phone') ? 'input-error' : '' }}" 
                               value="{{ old('secondary_guardian_phone') }}">
                        @error('secondary_guardian_phone') 
                            <span class="text-error text-sm mt-1 block">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </span> 
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- 5. Sistema -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">⚙️ Configurações do Sistema</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="flex items-center gap-2">
                        <input type="checkbox" 
                               name="guardian_panel_access" 
                               value="1"
                               class=""
                               {{ old('guardian_panel_access') ? 'checked' : '' }}>
                        <span class="text-gray-500">Liberar acesso ao painel dos responsáveis?</span>
                    </label>
                    @error('guardian_panel_access') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>
            </div>
        </div>

        <!-- 6. Extras -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">📎 Extras</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="label text-gray-500" for="photo">Foto do aluno</label>
                    <input type="file" name="photo" id="photo" 
                           class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('photo') ? 'input-error' : '' }}" 
                           accept="image/*">
                    @error('photo') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>

                <div>
                    <label class="label text-gray-500" for="evaluation_file">Arquivo de avaliação ou laudo (PDF)</label>
                    <input type="file" name="evaluation_file" id="evaluation_file" 
                           class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('evaluation_file') ? 'input-error' : '' }}" 
                           accept=".pdf">
                    @error('evaluation_file') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>

                <div>
                    <label class="label text-gray-500" for="external_support_name">Nome do terapeuta/apoio externo</label>
                    <input type="text" name="external_support_name" id="external_support_name" 
                           class="bg-gray-100 border-gray-200 w-full rounded text-gray-500 {{ $errors->has('external_support_name') ? 'input-error' : '' }}" 
                           value="{{ old('external_support_name') }}">
                    @error('external_support_name') 
                        <span class="text-error text-sm mt-1 block">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span> 
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-2"></i> Cadastrar Aluno
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const classSelect = document.getElementById('class_id');
        const teacherSelect = document.getElementById('teacher_id');
        const classes = @json($classes);

        classSelect.addEventListener('change', function() {
            const selectedClassId = this.value;
            if (selectedClassId) {
                const selectedClass = classes.find(c => c.id == selectedClassId);
                if (selectedClass) {
                    teacherSelect.value = selectedClass.teacher_id;
                    teacherSelect.disabled = true;
                }
            } else {
                teacherSelect.value = '';
                teacherSelect.disabled = false;
            }
        });

        // Trigger change event if class is pre-selected
        if (classSelect.value) {
            classSelect.dispatchEvent(new Event('change'));
        }
    });
</script>
@endpush

@endsection 