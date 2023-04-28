import { createRouter, createWebHistory } from 'vue-router';
import {
    Categories,
    Home,
    Movements,
    Users,
    Login,
    SignUp,
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

export default router;