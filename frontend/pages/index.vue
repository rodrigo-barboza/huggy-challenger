<template>
    <section class="flex flex-col gap-6">
        <div class="text-2xl leading-[32px] tracking-[0%] text-center text-[#262626]">
            Login
        </div>
        <LoginForm
            class="min-w-[330px] sm:min-w-[400px]"
            @submit="onLogin"
        />
    </section>
</template>

<script setup>
definePageMeta({ layout: 'guest' });

const router = useRouter();
const { $toast } = useNuxtApp();
const { login } = useAuth();

const onLogin = async (payload) => {
    try {
        await login(payload);
        router.push('/contacts');
    } catch (error) {
        $toast.error('Credenciais inválidas');
    }
};

</script>
