import { createRouter, createWebHistory } from 'vue-router';
import Users from '../components/Users.vue';

const routes = [
    {
        path: '/users-list',
        name: 'Users List',
        component: Users,
        // props: true,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;