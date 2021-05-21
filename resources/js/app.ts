
import Airwire from './airwire';

import { createApp, reactive } from 'vue';

createApp(require('./components/Main.vue').default)
    .use(Airwire.plugin('vue')(reactive))
    .mount('#app')

Airwire.watch(response => {
    if (response.metadata.notification) {
        window.notify(response.metadata.notification);
    }
}, exception => {
    alert(exception.message);
})


declare module 'vue' {
    export interface ComponentCustomProperties {
        $airwire: typeof window.Airwire
    }
}
