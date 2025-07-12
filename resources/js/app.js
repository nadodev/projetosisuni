import './bootstrap';
import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import focus from '@alpinejs/focus';

// Make Alpine available globally
window.Alpine = Alpine;

// Add plugins
Alpine.plugin(intersect);
Alpine.plugin(focus);
