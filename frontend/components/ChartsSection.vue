<template>

    <section class="flex flex-col gap-[80px] px-14 py-6">
        <div
            v-for="({ title, data }, index) in insights"
            class="flex flex-col gap-8"
            :key="index"
        >
            <div class="text-sm font-medium leading-[18px] tracking-[0.1px] text-[#262626]">
                {{ title }}
            </div>
            <PieChart
                :series="getSeries(data)"
                :labels="getLabels(data)"
            />
        </div>
    </section>
</template>

<script setup>

const props = defineProps({
    insights: {
        type: Array,
        required: true,
    },
});

const getLabels = (data) => {
    if (data.length === 0) return [];

    return data.map(item => Object.values(item)[0]);
};

const getSeries = (data) => {
    if (data.length === 0) return [];

    return data.map(item => Object.values(item)[1]);
};

</script>
