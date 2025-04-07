import { defineStore } from 'pinia';

export const useAuthStore = defineStore('auth', () => {
    const user = ref({});
    const accessToken = ref('');

    const clearAuth = () => {
        user.value = {};
        accessToken.value = '';
    };

    return { user, accessToken, clearAuth };
}, {
    persist: {
        storage: localStorage,
        pick: ['accessToken'],
    },
});
