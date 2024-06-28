import { defineStore } from 'pinia'
import { AUTH_URL, REGISTER_URL } from '@/constants'
import axios from 'axios'
import {ref} from "vue";

export const useAuthStore = defineStore('auth', () => {
    const userInfo = ref({
        token: '',
    })

    const errFlag = ref(false);

    const networkErr = ref('');

    const registerErr = ref(false)

    const auth = async(login, pass) => {
        try {
            errFlag.value = false
            const dataInfo = {
                "phone": login,
                "password": pass
            }
            let response = await axios.post(AUTH_URL, dataInfo)
            const token = response.data.access_token
            userInfo.value.token = token;
            localStorage.setItem('token', token)
        } catch(e) {
            errFlag.value = true
        }
    }

    const register = async(obj) => {
        try {
            const data = await axios.post(REGISTER_URL, obj)
        } catch (e) {
            console.log(e)
            registerErr.value = true
        }
    }


    const logout = () => {
        userInfo.value.token = ''
    }

    return { userInfo, errFlag, auth, register, logout, networkErr, registerErr }
})
