<template>
    <client-only>
        <component
            :is="ApexChart"
            type="pie"
            width="500"
            :options="chartOptions"
            :series="series"
        />
    </client-only>
</template>

<script setup>

const props = defineProps({
    series: {
        type: Array,
        default: () => ([44, 55, 13, 43, 22]),
        required: true,
    },
    labels: {
        type: Array,
        default: () => (['Team A', 'Team B', 'Team C', 'Team D', 'Team E']),
        required: true,
    },
});

const series = ref([]);

const chartOptions = ref({
    chart: {
        width: 450,
        id: 'pie-chart',
        type: 'pie',
        animations: {
            enabled: true
        },
        toolbar: {
            show: false
        }
    },
    labels: [],
    colors: ['#2E4053', '#3A5199', '#4F6CA5', '#6A7FBF', '#8A9BD7'],
    legend: {
        position: 'right',
        orientation: 'vertical',
        offsetX: -100,
        offsetY: 0,
    },
    responsive: [{
        breakpoint: 680,
        options: {
            chart: {
                width: 550,
                position: 'center',
            },
            legend: {
                show: false,
                onItemHover: {
                    highlightDataSeries: true
                }
            }
        }
    },
    {
        breakpoint: 480,
        options: {
            chart: {
                width: 350,
                position: 'center',
            },
            legend: {
                position: 'bottom',
                height: 150
            }
        }
    }],
    dataLabels: {
        enabled: false
    }
});

const ApexChart = shallowRef(null);

onMounted(async () => {
    series.value = props.series;
    chartOptions.value.labels = props.labels;

    const module = await import('vue3-apexcharts');
    ApexChart.value = module.default;
});

</script>