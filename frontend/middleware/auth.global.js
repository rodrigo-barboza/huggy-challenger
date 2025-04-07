export default defineNuxtRouteMiddleware(async (to) => {
    const authStore = useAuthStore();
    const publicRoutes = ['/'];

    if (to.path === '/' && authStore.accessToken) {
        return navigateTo('/contacts');
    }

    if (publicRoutes.includes(to.path)) {
        return;
    }

    try {
        if (!authStore.accessToken) {
            throw new Error('No access token');
        }

        if (to.path === '/') {
            return navigateTo('/contacts');
        }
    } catch (error) {
        authStore.clearAuth();

        return navigateTo('/', {
            redirectCode: 401,
            replace: true,
            query: {
                redirect: to.path === '/' ? undefined : to.fullPath
            }
        });
    }
});
