<template>
    <div>
        <PageHeader title="Dados sobre contatos" />
        <Card>
            <BackRouteButton back-route="/contacts" />
            <ChartsSection />
        </Card>
    </div>
</template>

<script setup>
definePageMeta({ layout: 'authenticated' });

</script>
