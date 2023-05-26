import { createRouter, createWebHistory } from 'vue-router';
import {
    Auth,
    Categories,
    Home,
    Login,
    Movements,
    SignUp,
    Users,
} from '../components';

const routes = [
    {
        path: '/',
        name: 'Home',
        alias: ['/home', '/index'], // multiple paths point to the same component
        component: Home,
        // props: true,
    },
    {
        path: '/auth',
        name: 'Auth',
        component: Auth,
        meta: { requiresAuth: true }
    },
    {
        path: '/login',
        name: 'Login Form',
        component: Login,
        // props: true,
    },
    {
        path: '/signup',
        name: 'Signup Form',
        component: SignUp,
        // props: true,
    },
    {
        path: '/users',
        name: 'Users',
        component: Users,
        meta: {
            methods: {
                'GET': 'readUsers, readUser',
                'POST': 'createUser',
                'PUT': 'updateUser',
                'PATCH': 'updateUser',
                'DELETE': 'deleteUser',
            },
        }
        // props: true,
    },
    {
        path: '/categories',
        name: 'Categories',
        component: Categories,
        meta: {
            methods: {
                'GET': 'readCategories, readCategory',
                'POST': 'createCategory',
                'PUT': 'updateCategory',
                'PATCH': 'updateCategory',
                'DELETE': 'deleteCategory',
            },
        }
        // props: true,
    },
    {
        path: '/movements',
        name: 'Movements',
        component: Movements,
        meta: {
            methods: {
                'GET': 'readMovements, readMovement',
                'POST': 'createMovement',
                'PUT': 'updateMovement',
                'PATCH': 'updateMovement',
                'DELETE': 'deleteMovement',
            },
        }
        // props: true,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !to.auth) {
        next('/login');
    } else {
        next();
    }
});

export default router;