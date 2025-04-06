<template>
    <div class="flex flex-col gap-6 items-center justify-center">
        <div class="flex flex-col items-center gap-4">
            <img :src="image">
            <div class="text-[#757575] text-base leading-[24px]">{{ title }}</div>
        </div>
        <PrimaryButton>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                    clip-rule="evenodd" />
            </svg>
            {{ actionText }}
        </PrimaryButton>
    </div>
</template>

<script setup>

defineProps({
    title: {
        type: String,
        required: true,
    },
    image: {
        type: String,
        required: true,
    },
    actionText: {
        type: String,
        required: true,
    },
});

</script>