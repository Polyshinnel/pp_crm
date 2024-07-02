import { createWebHistory, createRouter } from 'vue-router'
import routes from '@/router/routes.js';
import {useAuthStore} from "@/stores/auth.js";


const router = createRouter({
    history: createWebHistory(),
    routes,
})


router.beforeEach((to, from, next) => {
    const authStore = useAuthStore()
    if(to.meta.auth && !authStore.userInfo.token) {
        next('/auth')
    } else if(!to.meta.auth && authStore.userInfo.token) {
        next('/')
    } else {
        next();
    }
})



export default router
