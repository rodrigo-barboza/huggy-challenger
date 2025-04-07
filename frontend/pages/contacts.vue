<template>
    <div>
        <PageHeader title="Contatos" />
        <Card>
            <ContactsActionsSection @open-new-contact-modal="showNewContactModal = true"/>
            <ContactsTable
                :items="contacts"
                @open-new-contact-modal="showNewContactModal = true"
                @item-click="handleContactClick"
                @call="handleCallContact"
                @delete="handleDeleteContact"
                @edit="handleEditContact"
            />
        </Card>
        <NewContactModal v-model="showNewContactModal" />
        <ContactInfoModal
            v-model="showContactInfoModal"
            :contact="selectedContact"
            @call="handleCallContact"
            @delete="handleDeleteContact"
            @edit="handleEditContact"
        />
        <AppConfirmModal
            v-model="showConfirmDeleteModal"
            title="Excluir este contato?"
            button-confir-label="Excluir"
            @confirm="deleteContact"
        />
        <EditContactModal
            v-model="showEditContactModal"
            :contact="selectedContact"
        />
    </div>
</template>

<script setup>
definePageMeta({ layout: 'authenticated' });

const contacts = ref([{
        id: 1,
        name: 'João Carlos',
        email: 'joao.carlos@gmail.com',
        phone: null,
    },
    {
        id: 2,
        name: 'Maria Fernanda',
        email: 'maria.fernanda@gmail.com',
        phone: '11987654321',
    },
    {
        id: 3,
        name: 'Pedro Henrique',
        email: 'pedro.henrique@gmail.com',
        phone: '11555555555',
    },
    {
        id: 4,
        name: 'Ana Beatriz',
        email: 'ana.beatriz@gmail.com',
        phone: '11555555555',
    },
    {
        id: 5,
        name: 'Felipe Augusto',
        email: null,
        phone: '11555555555',
    },
    {
        id: 6,
        name: 'Luiza Helena',
        email: 'luiza.helena@gmail.com',
        phone: '11555555555',
    },
    {
        id: 7,
        name: 'Guilherme Eduardo',
        email: 'guilherme.eduardo@gmail.com',
        phone: '11555555555',
    },
    {
        id: 8,
        name: 'Gabriel Francisco',
        email: 'gabriel.francisco@gmail.com',
        phone: '11555555555',
    },
    {
        id: 9,
        name: 'Thiago Rafael',
        email: 'thiago.rafael@gmail.com',
        phone: '11555555555',
    },]);
const selectedContact = ref(null);
const showNewContactModal = ref(false);
const showContactInfoModal = ref(false);
const showConfirmDeleteModal = ref(false);
const showEditContactModal = ref(false);

const handleContactClick  = (contact) => (selectedContact.value = contact, showContactInfoModal.value = true);

const handleEditContact = (contact) => {
    selectedContact.value = contact;
    showContactInfoModal.value = false;
    showEditContactModal.value = true;
};

const handleDeleteContact = (contact) => {
    selectedContact.value = contact;
    showContactInfoModal.value = false;
    showConfirmDeleteModal.value = true;
};

const deleteContact = () => {
    showConfirmDeleteModal.value = false;
    console.log('vou deletar de verdade!!');
};

const handleCallContact = (contact) => {
    console.log('Ligando para o contato', contact);
};

</script>
