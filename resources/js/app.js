
require('./bootstrap');

import { createApp, h } from 'vue';
import {createInertiaApp, Head, Link} from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';
// console.log('Still working well without duplicating url.....')
createInertiaApp({
    id: 'app',
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) 
    {

        // Creating an istance of Vue.js app
        
        console.log(props.initialPage.url);
        // props.initialPage.url = '/laravel/test?ssds=sdssd';
        // console.log(props.initialPage.url);
        
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .component('Link', Link)
            .component('Head', Head)
            .mixin({ methods: { route } })
            .mount(el);

    },
});

InertiaProgress.init({ color: 'red' });
