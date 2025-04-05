<template>
  <NuxtLayout>
    <NuxtLoadingIndicator />
    <NuxtPage :transition="{ name: 'page', mode: 'out-in' }" />
    <!-- <h1>Login</h1>
    <button @click="handleLogin">Fazer login com a Huggy</button> -->
  </NuxtLayout>
</template>

<script setup>

const handleLogin = async () => {
  const { data } = await useApi('/api/test');
  
  window.location.href = data;
};

</script>
