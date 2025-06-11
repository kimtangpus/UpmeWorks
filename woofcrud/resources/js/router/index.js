import { createRouter, createWebHistory } from "vue-router";

import dogIndex from '../components/dogs/Index.vue'
import dogForm from '../components/dogs/Form.vue'

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
        component: dogForm
    },
    {
        path: '/dogs/:id/edit',
        name: 'dogs.edit',
        component: dogForm
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
        