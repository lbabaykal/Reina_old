import './bootstrap';
import '../css/app.css';
import 'flowbite';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});


window.onload = function(){
    window.dispatchEvent(new Event("scroll"));
}

window.addEventListener("scroll",function() {
    let header = document.getElementById('header');
    let menu = document.getElementById('MenuDropdownButton');

    if (window.scrollY > 60) {
        // header.classList.add('!bg-black', 'shadow-md', 'shadow-red-600/50');
        header.classList.add('header-change');
        menu.classList.add('hover:bg-white/25');
        menu.classList.remove('hover:bg-black');
    } else {
        header.classList.remove('header-change');
        menu.classList.remove('hover:bg-white/25');
        menu.classList.add('hover:bg-black');
    }
});
