import './bootstrap';
import './tynce';
import Alpine from 'alpinejs';
import Sortable from 'sortablejs';
import axios from 'axios';

// Inicializa o Alpine.js
window.Alpine = Alpine;
Alpine.start();

// Inicializa o SortableJS
document.addEventListener('DOMContentLoaded', () => {
    const formFieldsList = document.getElementById('form-fields-list');
    if (formFieldsList) {
        Sortable.create(formFieldsList, {
            animation: 150,
            handle: '.cursor-move',
            onEnd: function (evt) {
                const order = Array.from(formFieldsList.children).map((item, index) => ({
                    id: item.dataset.id,
                    order: index
                }));
                // Envia a ordem atualizada para o servidor
                axios.post('/fields/update-order', { order })
                    .then(response => {
                        console.log('Ordem atualizada com sucesso');
                    })
                    .catch(error => {
                        console.error('Erro ao atualizar a ordem', error);
                    });
            }
        });
    }
});
