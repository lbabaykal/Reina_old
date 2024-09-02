import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/', component: () => import('./Pages/Main.vue'),
            name: 'main'
        },
        {
            path: '/animes', component: () => import('./Pages/Animes/Index.vue'),
            name: 'animes.index'
        },
        {
            path: '/doramas', component: () => import('./Pages/Doramas/Index.vue'),
            name: 'doramas.index'
        },
        {
            path: '/login', component: () => import('./Pages/Auth/Login.vue'),
            name: 'login'
        },
        {
            path: '/logout', component: () => import('./Pages/Auth/AppLayout.vue'),
            name: 'logout'
        },
    ]
})

export default router
