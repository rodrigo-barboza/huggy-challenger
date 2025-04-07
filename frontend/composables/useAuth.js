import { useRouter } from 'vue-router';

export const useAuth = () => {
    const router = useRouter();
    const config = useRuntimeConfig();
    const authStore = useAuthStore();
    const { $axios } = useNuxtApp();

    const ensureCSRF = async () => {
        try {
            await $axios.get('/sanctum/csrf-cookie', {
                baseURL: config.public.apiBase,
                withCredentials: true
            });
            return true;
        } catch (error) {
            console.error('CSRF Error:', error);
            return false;
        }
    };

    const login = async (credentials) => {
        await ensureCSRF();

        try {
            const { data } = await $axios.post('/api/auth/login', credentials);

            authStore.accessToken = data.token;

            return data;
        } catch (error) {
            if (error.response?.status === 419) {
                await ensureCSRF();
                throw { message: 'Session expired, please try again' };
            }
            throw error.response?.data || { message: 'Login failed' };
        }
    };

    const logout = async () => {
        try {
            await $axios.post('/api/auth/logout');
            authStore.accessToken = null;
            router.push('/');
        } catch (error) {
            console.error('Logout failed:', error);
        }
    };

    const getUser = async () => {
        try {
            const response = await $axios.get('/api/user');
            return response.data;
        } catch (error) {
            return null;
        }
    };

    return {
        login,
        logout,
        getUser
    };
};
