import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Timeout padrão: 10 segundos (10000 ms)
window.axios.defaults.timeout = 10000;

// CSRF token (garanta que suas blades tenham <meta name="csrf-token" ... />)
const token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}
