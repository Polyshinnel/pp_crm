import axios from "axios";
import { useAuthStore } from "@/stores/auth.js";

const axiosApiInstance = axios.create()

axiosApiInstance.interceptors.request.use((config) => {
        const authStore = useAuthStore()
        config.headers.authorization = `Bearer ${authStore.userInfo.token}`
        return config
    }, function(error) {
        const authStore = useAuthStore()
        authStore.logout()
    }
)

axiosApiInstance.interceptors.response.use((response) => {
    return response
}, async function (error) {
    const status = error.response.status;
    if(status === 401) {
        const authStore = useAuthStore()
        console.log(error)
        authStore.networkErr = error.response.data.detail
        authStore.logout()
        localStorage.clear()
    }
    return Promise.reject(error);
})

export default axiosApiInstance
