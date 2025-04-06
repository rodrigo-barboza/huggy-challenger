<template>
    <div class="py-6 px-7 flex gap-2 items-center cursor-pointer w-fit" @click="backTo">
        <LeftArrowIcon />
        <span class="text-sm font-medium leading-[18px]">Voltar</span>
    </div>
</template>

<script setup>
import { useRouter } from 'vue-router';	

const router = useRouter();

const props = defineProps({
    backRoute: {
        type: String,
        required: true,
    },
});

const backTo = () => {
    if (!props.backRoute) {
        router.back();
    }

    router.push(props.backRoute);
};

</script>
