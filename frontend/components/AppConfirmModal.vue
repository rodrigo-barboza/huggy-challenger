<template>
    <div v-if="model" class="fixed inset-0 bg-black/35 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-sm">
            <div class="p-6">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-medium text-black">{{ title }}</h3>
                </div>
            </div>
            <div class="p-4 flex justify-end">
                <SecondaryButton @click="model = false">Cancelar</SecondaryButton>
                <SecondaryButton
                    color="red"
                    @click="emit('confirm')"
                >
                    {{ buttonConfirLabel }}
                </SecondaryButton>
            </div>
        </div>
    </div>
</template>

<script setup>
const emit = defineEmits(['confirm']);

const model = defineModel({
    type: Boolean,
    default: false,
});

defineProps({
    title: {
        type: String,
        required: true,
    },

    buttonConfirLabel: {
        type: String,
        required: true,
        default: 'Confirmar',
    },
});

</script>
