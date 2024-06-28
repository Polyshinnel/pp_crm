import Auth from "@/pages/Auth/Auth.vue";
import Register from "@/pages/Auth/Register.vue";
import Home from "@/pages/Home.vue";

const routes = [
    {
        path: '/auth',
        name: 'Authorization',
        component: Auth,
        meta: {
            auth: false
        }
    },
    {
        path: '/register',
        name: 'Registration',
        component: Register,
        meta: {
            auth: false
        }
    },
    {
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            auth: true
        }
    },
]

export default routes
