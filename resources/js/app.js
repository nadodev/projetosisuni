import './bootstrap';
import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';

// Make Alpine available globally
window.Alpine = Alpine;

// Initialize Alpine.js with plugins
Alpine.plugin(intersect);

// Start Alpine.js
Alpine.start();
