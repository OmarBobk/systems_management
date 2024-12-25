import './bootstrap';

import Alpine from 'alpinejs';
// import Chart from 'chart.js/auto';
import Chart from 'chart.js';

window.Alpine = Alpine;

Alpine.start();


import.meta.glob([
    '../images/**',
    '../fonts/**',
]);
