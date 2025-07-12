<div class="p-6">
    <h2 class="text-lg font-semibold mb-4">Perfil Educacional - {{ $student->name }}</h2>

    @if (session()->has('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-error mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6">
        <!-- Neurodivergências -->
        <div class="space-y-4">
            <h3 class="text-md font-medium">Neurodivergências</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <label class="flex items-center space-x-3">
                    <input type="checkbox" wire:model="has_autism" class="checkbox checkbox-primary">
                    <span>TEA (Autismo)</span>
                </label>
                <label class="flex items-center space-x-3">
                    <input type="checkbox" wire:model="has_adhd" class="checkbox checkbox-primary">
                    <span>TDAH</span>
                </label>
                <label class="flex items-center space-x-3">
                    <input type="checkbox" wire:model="has_dyslexia" class="checkbox checkbox-primary">
                    <span>Dislexia</span>
                </label>
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">Outras Neurodivergências</label>
                <select wire:model="other_neurodivergences" class="select select-bordered w-full" multiple>
                    <option value="discalculia">Discalculia</option>
                    <option value="disgrafia">Disgrafia</option>
                    <option value="toc">TOC</option>
                    <option value="outros">Outros</option>
                </select>
            </div>
        </div>

        <!-- Preferências de Aprendizagem -->
        <div class="space-y-4">
            <h3 class="text-md font-medium">Preferências de Aprendizagem</h3>
            <select wire:model="learning_preferences" class="select select-bordered w-full" multiple>
                <option value="visual">Visual</option>
                <option value="auditivo">Auditivo</option>
                <option value="cinestesico">Cinestésico</option>
                <option value="leitura_escrita">Leitura/Escrita</option>
                <option value="manipulacao">Manipulação de Objetos</option>
                <option value="tecnologia">Uso de Tecnologia</option>
                <option value="grupo">Trabalho em Grupo</option>
                <option value="individual">Trabalho Individual</option>
            </select>
        </div>

        <!-- Estímulos a Evitar -->
        <div class="space-y-4">
            <h3 class="text-md font-medium">Estímulos a Evitar</h3>
            <select wire:model="stimuli_to_avoid" class="select select-bordered w-full" multiple>
                <option value="luz_forte">Luz Forte</option>
                <option value="sons_altos">Sons Altos</option>
                <option value="muitas_pessoas">Muitas Pessoas</option>
                <option value="mudancas_rotina">Mudanças de Rotina</option>
                <option value="texturas">Certas Texturas</option>
                <option value="cheiros_fortes">Cheiros Fortes</option>
            </select>
        </div>

        <!-- Apoios Necessários -->
        <div class="space-y-4">
            <h3 class="text-md font-medium">Apoios Necessários</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <label class="flex items-center space-x-3">
                    <input type="checkbox" wire:model="needs_reading_support" class="checkbox checkbox-primary">
                    <span>Leitura em Voz Alta</span>
                </label>
                <label class="flex items-center space-x-3">
                    <input type="checkbox" wire:model="needs_extra_time" class="checkbox checkbox-primary">
                    <span>Tempo Extra</span>
                </label>
                <label class="flex items-center space-x-3">
                    <input type="checkbox" wire:model="needs_constant_help" class="checkbox checkbox-primary">
                    <span>Auxílio Constante</span>
                </label>
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">Outros Apoios Necessários</label>
                <select wire:model="other_support_needs" class="select select-bordered w-full" multiple>
                    <option value="material_adaptado">Material Adaptado</option>
                    <option value="tecnologia_assistiva">Tecnologia Assistiva</option>
                    <option value="mediador">Mediador</option>
                    <option value="local_calmo">Local Calmo</option>
                    <option value="intervalos">Intervalos Frequentes</option>
                </select>
            </div>
        </div>

        <!-- Observações -->
        <div class="space-y-4">
            <h3 class="text-md font-medium">Observações</h3>
            <div>
                <label class="block text-sm font-medium mb-2">Observações Gerais</label>
                <textarea wire:model="general_observations" class="textarea textarea-bordered w-full" rows="3"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">Notas do Professor</label>
                <textarea wire:model="teacher_notes" class="textarea textarea-bordered w-full" rows="3"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">Notas do Profissional de Apoio</label>
                <textarea wire:model="support_professional_notes" class="textarea textarea-bordered w-full" rows="3"></textarea>
            </div>
        </div>

        <div class="flex justify-end space-x-3">
            <button type="button" wire:click="$dispatch('closeModal')" class="btn">Cancelar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>
</div>
