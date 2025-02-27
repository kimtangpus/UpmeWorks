import { createRouter, createWebHistory } from "vue-router";

import dogCreate from '../components/DogCreate.vue'
import dogIndex from '../components/DogIndex.vue'
import notFound from '../components/NotFound.vue'

const routes = [
    {
        path: '/',
        name: 'dogs.index',
        component: dogIndex
    },
    {
        path: '/dogs/create',
        name: 'dogs.create',
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
        