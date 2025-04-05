<template>
    <div>
        <PageHeader title="Contatos" />
        <Card>
            <ContactsActionsSection @open-new-contact-modal="showNewContactModal = true"/>
            <ContactsTable @item-click="handleContactClick" />
        </Card>
        <NewContactModal v-model="showNewContactModal" />
        <ContactInfoModal
            v-model="showContactInfoModal"
            :contact="selectedContact"
            @edit="handleEditContact"
            @delete="handleDeleteContact"
        />
        <AppConfirmModal
            v-model="showConfirmDeleteModal"
            title="Excluir este contato?"
            button-confir-label="Excluir"
            @confirm="deleteContact"
        />
    </div>
</template>

<script setup>
definePageMeta({ layout: 'authenticated' });

const selectedContact = ref(null);
const showNewContactModal = ref(false);
const showContactInfoModal = ref(false);
const showConfirmDeleteModal = ref(false);

const handleContactClick  = (contact) => (selectedContact.value = contact, showContactInfoModal.value = true);

const handleEditContact = (contact) => {
    selectedContact.value = contact;
    showContactInfoModal.value = false;
    console.log('vou editar');
};

const handleDeleteContact = (contact) => {
    selectedContact.value = contact;
    showContactInfoModal.value = false;
    showConfirmDeleteModal.value = true;
    console.log('vou deletar');
};

const deleteContact = () => {
    showConfirmDeleteModal.value = false;
    console.log('vou deletar de verdade!!');
};

</script>
