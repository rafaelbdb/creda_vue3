import { createRouter, createWebHistory } from 'vue-router';
import {
    Categories,
    CategoryCreate,
    CategoryEdit,
    Home,
    MovementCreate,
    MovementEdit,
    Movements,
    UserCreate,
    UserEdit,
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
        path: '/users',
        name: 'Users List',
        component: Users,
        // props: true,
    },
    {
        path: '/users/create',
        name: 'Create User',
        component: UserCreate,
        // props: true,
    },
    {
        path: '/users/:id/edit',
        name: 'Edit User',
        component: UserEdit,
        props: true,
    },
    {
        path: '/categories',
        name: 'Categories List',
        component: Categories,
        // props: true,
    },
    {
        path: '/categories/create',
        name: 'Create Category',
        component: CategoryCreate,
        // props: true,
    },
    {
        path: '/categories/:id/edit',
        name: 'Edit Category',
        component: CategoryEdit,
        props: true,
    },
    {
        path: '/movements',
        name: 'Movements List',
        component: Movements,
        // props: true,
    },
    {
        path: '/movements/create',
        name: 'Create Movement',
        component: MovementCreate,
        // props: true,
    },
    {
        path: '/movements/:id/edit',
        name: 'Edit Movement',
        component: MovementEdit,
        props: true,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;