<template>
    <div>
        <h2>Página de erro</h2>
        <p>{{ error.statusCode }}</p>
    </div>
</template>

<script setup>
defineProps({
    error: {
        type: Object,
    },
});

const backHome = () => clearError({ redirect: '/' });

</script>
