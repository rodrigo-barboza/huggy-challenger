<template>
    <section class="p-4 flex justify-between">
        <FilterInput v-bind="$attrs" />
        <div class="flex gap-4">
            <NewContactButton @click="emit('open-new-contact-modal')" />
            <InsightsButton />
        </div>
    </section>
</template>

<script setup>

const emit = defineEmits(['open-new-contact-modal']);

</script>
