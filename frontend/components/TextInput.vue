<template>
    <div class="flex flex-col gap-1">
        <label class="block text-sm font-medium text-gray-900">
            {{ label }}
        </label>
        <input
            v-model="model"
            @blur="field.handleBlur"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none block w-full p-2.5"
            :class="{ 'border-red-500': field.errorMessage.value }"
            :placeholder="placeholder"
            type="text"
        />
        <span
            v-if="field.errorMessage.value"
            class="mt-1 text-sm text-[#AD2213] font-medium"
        >
            {{ field.errorMessage.value }}
        </span>
    </div>
</template>

<script setup>

const model = defineModel({
    type: String,
    default: '',
});

defineProps({
    label: {
        type: String,
        default: '',
    },

    field: {
        type: Object,
        default: () => ({}),
    },

    placeholder: {
        type: String,
        default: '',
    },
});

</script>
