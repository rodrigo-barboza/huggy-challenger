<template>
    <section class="px-0 flex flex-col gap-2 mb-4 sm:gap-0 sm:p-4 sm:flex-row sm:justify-between sm:mb-0">
        <FilterInput v-bind="$attrs" />
        <div class="flex flex-col sm:flex-row gap-4">
            <NewContactButton @click="emit('open-new-contact-modal')" />
            <InsightsButton class="hidden sm:block"/>
        </div>
    </section>
</template>

<script setup>

const emit = defineEmits(['open-new-contact-modal']);

</script>
