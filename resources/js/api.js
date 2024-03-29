import axios from "axios";
import router from "./router/router";

const api = axios.create();
api.interceptors.request.use(config => {
    if (localStorage.getItem('access_token')) {
        config.headers.authorization = `Bearer ${localStorage.getItem('access_token')}`

    }
    return config
}, error => {

})
api.interceptors.response.use(config => {
    if (localStorage.getItem('access_token')) {
        config.headers.authorization = `Bearer ${localStorage.getItem('access_token')}`
    }
    return config
}, error => {
    if (error.response.data.message === 'Token has expired') {
        return axios.post('/api/auth/refresh', {}, {
            headers: {
                'authorization': `Bearer ${localStorage.getItem('access_token')}`
            }
        }).then(data => {
            localStorage.setItem('access_token', data.data.access_token)

            error.config.headers.authorization = `Bearer ${data.data.access_token}`

            return api.request(error.config)
        })
    }
    if (error.response.status === 401) {
        // router.push({name: "user.login"})
        document.location.href = '/login'
    }
})
export default api
