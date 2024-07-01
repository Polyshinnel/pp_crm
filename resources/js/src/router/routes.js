import Auth from "@/pages/Auth/Auth.vue";
import Register from "@/pages/Auth/Register.vue";
import Home from "@/pages/Home.vue";
import Forgotten from "@/pages/Auth/Forgotten.vue";
import UnAcceptUser from "@/pages/Auth/UnAcceptUser.vue";
import SuccessRegister from "@/pages/Auth/SuccessRegister.vue";

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
        path: '/forgotten',
        name: 'Forgotten',
        component: Forgotten,
        meta: {
            auth: false
        }
    },
    {
        path: '/unaccept',
        name: 'UnAccept',
        component: UnAcceptUser,
        meta: {
            auth: false
        }
    },
    {
        path: '/success-register',
        name: 'SuccessRegister',
        component: SuccessRegister,
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
