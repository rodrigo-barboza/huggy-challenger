<template>
    <button
        :class="`flex items-center font-medium gap-2 px-4 py-2 ${variants[props.color]} rounded-lg transition-colors duration-200`"
        :type="type"
    >
        <slot />
    </button>
</template>

<script setup>

const props = defineProps({
    color: {
        type: String,
        default: 'default',
        validator: (value) => ['default', 'red', 'info'].includes(value),
    },

    type: {
        type: String,
        default: 'button',
    },
});

const variants = {
    default: 'text-[#505050]',
    red: 'text-[#DE321B]',
    info: 'text-[#321BDE]',
};

</script>
