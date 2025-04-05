<template>
    <AppTable
        :fields="fields"
        :items="items"
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
                <EditIcon @click.stop="console.log('vou editar: ', item)" />
                <DeleteIcon @click.stop="console.log('vou deletar: ', item)" />
            </div>
        </template>
    </AppTable>
</template>

<script setup>
const emit = defineEmits(['item-click']);

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

const items = [
    {
        id: 1,
        name: 'João Carlos',
        email: 'joao.carlos@gmail.com',
        phone: null,
    },
    {
        id: 2,
        name: 'Maria Fernanda',
        email: 'maria.fernanda@gmail.com',
        phone: '(11) 98765-4321',
    },
    {
        id: 3,
        name: 'Pedro Henrique',
        email: 'pedro.henrique@gmail.com',
        phone: '(11) 55555-5555',
    },
    {
        id: 4,
        name: 'Ana Beatriz',
        email: 'ana.beatriz@gmail.com',
        phone: '(11) 55555-5555',
    },
    {
        id: 5,
        name: 'Felipe Augusto',
        email: null,
        phone: '(11) 55555-5555',
    },
    {
        id: 6,
        name: 'Luiza Helena',
        email: 'luiza.helena@gmail.com',
        phone: '(11) 55555-5555',
    },
    {
        id: 7,
        name: 'Guilherme Eduardo',
        email: 'guilherme.eduardo@gmail.com',
        phone: '(11) 55555-5555',
    },
    {
        id: 8,
        name: 'Gabriel Francisco',
        email: 'gabriel.francisco@gmail.com',
        phone: '(11) 55555-5555',
    },
    {
        id: 9,
        name: 'Thiago Rafael',
        email: 'thiago.rafael@gmail.com',
        phone: '(11) 55555-5555',
    },
];

</script>
