import './bootstrap';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

// Initialize Alpine.js
window.Alpine = Alpine;
Alpine.plugin(focus);
Alpine.start();

// Cart functionality
document.addEventListener('DOMContentLoaded', () => {
    // Initialize cart functionality if needed
    console.log('CafeShop app initialized');
});
