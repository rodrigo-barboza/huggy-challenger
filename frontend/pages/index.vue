<template>
    <section class="flex flex-col gap-6">
        <div class="text-2xl leading-[32px] tracking-[0%] text-center text-[#262626]">
            Login
        </div>
        <LoginForm
            class="min-w-[400px]"
            @submit="onLogin"
        />
        <PrimaryButton
            class="self-center w-fit"
            @click="handleHuggyLogin"
        >
            Fazer login com a Huggy
        </PrimaryButton>
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

const handleHuggyLogin = async () => {
  const { data } = await useApi('get', '/api/test');
  
  window.location.href = data;
};

</script>
