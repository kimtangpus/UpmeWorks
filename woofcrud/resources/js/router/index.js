import { createRouter, createWebHistory } from "vue-router";

import dogIndex from '../components/dogs/Index.vue'
import notFound from '../components/NotFound.vue'

const routes = [
    {
        path: '/',
        name: 'dogs.index',
        component: dogIndex
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'not-found',
        component: notFound
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes

    });


export default router; 
        