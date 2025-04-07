<template>
        <AppTable
            :fields="fields"
            :items="items"
            @open-new-contact-modal="emit('open-new-contact-modal')"
            @item-click="emit('item-click', $event)"
        >
            <template #name="{ item }">
                <div class="flex items-center gap-4">
                    <img
                        class="rounded-full"
                        :src="generateAvatar(item.name)"
                    >
                    <span>{{ item.name }}</span>
                </div>
            </template>
            <template #actions="{ item }">
                <div class="flex gap-4">
                    <PhoneIcon
                        v-if="item.phone"
                        @click.stop="emit('call', item)"
                    />
                    <EditIcon @click.stop="emit('edit', item)" />
                    <DeleteIcon @click.stop="emit('delete', item)" />
                </div>
            </template>
        </AppTable>
</template>

<script setup>

const emit = defineEmits([
    'open-new-contact-modal',
    'item-click',
    'edit',
    'delete',
    'call'
]);

defineProps({
    items: {
        type: Array,
        required: true,
    },
});

const { generateAvatar } = useUtils();

const fields = [
    {
        name: 'name',
        label: 'Nome',
        sortable: true,
    },
    {
        name: 'email',
        label: 'Email',
    },
    {
        name: 'phone',
        label: 'Telefone',
    },
];

</script>
