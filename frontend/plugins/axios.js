import { defineNuxtPlugin } from '#app';
import axios from 'axios';

export default defineNuxtPlugin((nuxtApp) => {
    const config = useRuntimeConfig();
    const store = useAuthStore();

    const instance = axios.create({
        baseURL: config.public.apiBase,
        withCredentials: true,
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    });

    instance.interceptors.request.use(async (config) => {
        if (['post', 'put', 'delete', 'patch'].includes(config.method?.toLowerCase() || '')) {
            const csrfToken = getCSRFToken();
            if (csrfToken) {
                config.headers['X-XSRF-TOKEN'] = csrfToken;
            }
        }

        if (store.accessToken) {
            config.headers.Authorization = `Bearer ${store.accessToken}`;
        }

        return config;
    });

    const getCSRFToken = () => {
        if (process.client) {
            const cookie = document.cookie.match(/XSRF-TOKEN=([^;]+)/);
            return cookie ? decodeURIComponent(cookie[1]) : null;
        }
        return null;
    };

    return {
        provide: {
            axios: instance
        }
    };
});