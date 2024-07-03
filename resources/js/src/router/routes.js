import Auth from "@/pages/Auth/Auth.vue";
import Register from "@/pages/Auth/Register.vue";
import Home from "@/pages/Home.vue";
import Forgotten from "@/pages/Auth/Forgotten.vue";
import UnAcceptUser from "@/pages/Auth/UnAcceptUser.vue";
import SuccessRegister from "@/pages/Auth/SuccessRegister.vue";
import TasksPage from "@/pages/TasksPage.vue";
import ProjectsPage from "@/pages/Sales/Projects/ProjectsPage.vue";
import SalesPage from "@/pages/Sales/Sales/SalesPage.vue";
import ClientsPage from "@/pages/Sales/Clients/ClientsPage.vue";
import WarehousePage from "@/pages/Warehouse/Warehouse/WarehousePage.vue";
import OrdersPage from "@/pages/Warehouse/Orders/OrdersPage.vue";
import SuppliersPage from "@/pages/Warehouse/Suppliers/SuppliersPage.vue";
import ProductsPage from "@/pages/Products/Products/ProductsPage.vue";
import CategoriesPage from "@/pages/Products/Categories/CategoriesPage.vue";
import CharacteristicsPage from "@/pages/Products/Characteristics/CharacteristicsPage.vue";
import ParametersPage from "@/pages/Products/Parameters/ParametersPage.vue";
import SettingsPage from "@/pages/Common/Settings/SettingsPage.vue";
import BrandsPage from "@/pages/Products/Brands/BrandsPage.vue";
import BrandsCreatePage from "@/pages/Products/Brands/BrandsCreatePage.vue";
import BrandsPageEdit from "@/pages/Products/Brands/BrandsPageEdit.vue";

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

    {
        path: '/tasks',
        name: 'tasks',
        component: TasksPage,
        meta: {
            auth: true
        }
    },

    {
        path: '/projects',
        name: 'projects',
        component: ProjectsPage,
        meta: {
            auth: true
        }
    },

    {
        path: '/sales',
        name: 'sales',
        component: SalesPage,
        meta: {
            auth: true
        }
    },

    {
        path: '/clients',
        name: 'clients',
        component: ClientsPage,
        meta: {
            auth: true
        }
    },

    {
        path: '/warehouses',
        name: 'warehouses',
        component: WarehousePage,
        meta: {
            auth: true
        }
    },

    {
        path: '/orders',
        name: 'orders',
        component: OrdersPage,
        meta: {
            auth: true
        }
    },

    {
        path: '/suppliers',
        name: 'suppliers',
        component: SuppliersPage,
        meta: {
            auth: true
        }
    },

    {
        path: '/products',
        name: 'products',
        component: ProductsPage,
        meta: {
            auth: true
        }
    },

    {
        path: '/brands',
        name: 'brands',
        component: BrandsPage,
        meta: {
            auth: true
        }
    },
    {
        path: '/brands/create',
        name: 'brands-create',
        component: BrandsCreatePage,
        meta: {
            auth: true
        }
    },
    {
        path: '/brands/:brandId',
        name: 'brands-edit',
        component: BrandsPageEdit,
        meta: {
            auth: true
        }
    },


    {
        path: '/categories',
        name: 'categories',
        component: CategoriesPage,
        meta: {
            auth: true
        }
    },

    {
        path: '/characteristics',
        name: 'characteristics',
        component: CharacteristicsPage,
        meta: {
            auth: true
        }
    },

    {
        path: '/phis-parameters',
        name: 'parameters',
        component: ParametersPage,
        meta: {
            auth: true
        }
    },

    {
        path: '/settings',
        name: 'settings',
        component: SettingsPage,
        meta: {
            auth: true
        }
    },
]

export default routes
