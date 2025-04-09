<template>
  <NuxtLayout>
    <NuxtLoadingIndicator />
    <NuxtPage :transition="{ name: 'page', mode: 'out-in' }" />
  </NuxtLayout>
</template>
