<template>
    <div v-if="model" class="fixed inset-0 bg-black/35 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-[610px]">
            <div class="p-6">
                <div
                    v-if="!hasSlots($slots, 'header')"
                    class="flex justify-between items-center"
                >
                    <h3 class="text-lg font-semibold text-gray-900">{{ title }}</h3>
                </div>
                <slot
                    v-else
                    name="header"
                />
            </div>
            <hr class="w-full h-px bg-gray-200 border-0">
            <div class="p-6 max-h-[calc(100vh-210px)] overflow-y-auto">
                <slot></slot>
            </div>
            <template v-if="hasSlots($slots, 'actions')">
                <hr class="w-full h-px bg-gray-200 border-0">
                <div class="p-6 flex justify-end">
                    <slot name="actions"></slot>
                </div>
            </template>
        </div>
    </div>
</template>

<script setup>

const { hasSlots } = useUtils();

const model = defineModel({
    type: Boolean,
    default: false,
});

defineProps({
    title: {
        type: String,
        required: true,
    },
});

</script>
