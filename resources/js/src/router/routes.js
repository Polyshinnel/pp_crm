import Register from "@/pages/Common/Register.vue";
import Auth from "@/pages/Common/Auth.vue";

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
        name: 'Register',
        component: Register,
        meta: {
            auth: false
        }
    },
]

export default routes
