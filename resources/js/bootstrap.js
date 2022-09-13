window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.withCredentials = true;

axios.interceptors.response.use(res => res, err => {
    const statusCode = err.response.status;
    if (statusCode === 401 || statusCode === 403) {
        sessionStorage.clear();
        window.location = '/login';
    }
    throw err;
});