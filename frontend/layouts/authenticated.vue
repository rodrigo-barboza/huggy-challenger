<template>
    <div class="flex flex-col items-center">
        <SecondaryButton
            class="self-end w-fit"
            @click="logout"
        >
            Sair
        </SecondaryButton>
        <main class="w-full sm:w-[930px]">
            <slot></slot>
        </main>
    </div>
</template>

<script setup>
const { logout } = useAuth();
</script>
