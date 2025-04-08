<template>
    <div>
        <PageHeader title="Contatos" />
        <Card class="mb-6">
            <ContactsActionsSection
                @open-new-contact-modal="showNewContactModal = true"
                @filter="searchContacts"
            />
            <ContactsTable
                :items="contacts"
                @open-new-contact-modal="showNewContactModal = true"
                @item-click="handleContactClick"
                @call="handleCallContact"
                @delete="handleDeleteContact"
                @edit="handleEditContact"
            />
        </Card>
        <NewContactModal
            v-model="showNewContactModal"
            @create="createContact"
        />
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
            @edit="editContact"
        />
    </div>
</template>

<script setup>
definePageMeta({ layout: 'authenticated' });

const { $axios, $toast } = useNuxtApp();

const { makeCall } = useTwilio();

const contacts = ref([]);
const selectedContact = ref(null);
const showNewContactModal = ref(false);
const showContactInfoModal = ref(false);
const showConfirmDeleteModal = ref(false);
const showEditContactModal = ref(false);

const getContacts = async () => {
    try {
        const { data } = await $axios.get('/api/contacts');
        contacts.value = data.data;
    } catch (error) {
        $toast.error('Erro ao carregar a lista de contatos');
    }
};

const createContact = async (contact) => {
    try {
        const { data } = await $axios.post('/api/contacts', contact);
        $toast.success(data.message);
        showNewContactModal.value = false;
        await getContacts();
    } catch (error) {
        $toast.error('Erro ao salvar contato');
    }
};

const editContact = async (contact) => {
    try {
        const { data } = await $axios.put(`/api/contacts/${selectedContact.value.id}`, contact);
        $toast.success(data.message);
        showEditContactModal.value = false;
        await getContacts();
    } catch (error) {
        $toast.error('Erro ao editar contato');
    }
};

const deleteContact = async () => {
    showConfirmDeleteModal.value = false;

    try {
        const { data } = await $axios.delete(`/api/contacts/${selectedContact.value.id}`);
        $toast.success(data.message);
        await getContacts();
    } catch (error) {
        $toast.error('Erro ao excluir contato');
    }
};

const searchContacts = async (filter) => {
    try {
        const { data } = await $axios.get(`/api/contacts?search=${filter}`);
        contacts.value = data.data;
    } catch (error) {
        $toast.error('Erro ao buscar contatos');
    }
};

const handleContactClick  = (contact) => {
    selectedContact.value = contact;
    showContactInfoModal.value = true;
};

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

const handleCallContact = (contact) => makeCall(contact);

onMounted(() => getContacts());

</script>
