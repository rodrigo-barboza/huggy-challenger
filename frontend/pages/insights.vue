<template>
    <div>
        <PageHeader title="Dados sobre contatos" />
        <Card>
            <BackRouteButton back-route="/contacts" />
            <ChartsSection :insights="insights" />
        </Card>
    </div>
</template>

<script setup>
definePageMeta({ layout: 'authenticated' });

const { $axios, $toast } = useNuxtApp();

const insights = ref([]);

const getInsights = async () => {
    try {
        const { data } = await $axios.get('/api/contacts/insights');

        insights.value = data.data;
    } catch (error) {
        $toast.error('Erro ao buscar insights');
    }
};

onMounted(() => getInsights());

</script>
