window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.withCredentials = true;

// If some time has passed and session has expired
axios.interceptors.response.use(res => res, err => {
    const statusCode = err.response.status;
    if (statusCode === 401 || statusCode === 403) {
        localStorage.clear();
        window.location = '/login';
    }
    throw err;
});