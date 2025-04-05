import Vue3Toastify, { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

export default defineNuxtPlugin(({ vueApp }) => {
    if (process.client) {
        vueApp.use(Vue3Toastify, {
            position: "top-right",
            autoClose: 5000
        });

        return {
            provide: { toast },
        };
    }
});
