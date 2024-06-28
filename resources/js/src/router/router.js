import { createWebHistory, createRouter } from 'vue-router'
import routes from '@/router/routes.js';
import {useAuthStore} from "@/stores/auth.js";


const router = createRouter({
    history: createWebHistory(),
    routes,
})


router.beforeEach((to, from, next) => {
    const authStore = useAuthStore()
    console.log(authStore.userInfo)

    if(to.meta.auth && !authStore.userInfo.token) {
        next('/auth')
    }

    if(!to.meta.auth && authStore.userInfo.token) {
        next('/')
    }

    next();
})



export default router
