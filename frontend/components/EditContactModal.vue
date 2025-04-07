<template>
    <AppModal
        v-model="model"
        title="Editar contato"
    >
        <NewContactForm
            ref="form"
            :contact="contact"
            @form-values="onSubmit"
        />
        <template #actions>
            <div class="flex gap-1">
                <SecondaryButton @click="model = false">Cancelar</SecondaryButton>   
                <PrimaryButton @click="handleSubmit">Salvar</PrimaryButton>   
            </div>
        </template>
    </AppModal>
</template>

<script setup>

const emit = defineEmits(['edit']);

const model = defineModel({
    type: Boolean,
    default: false,
});

const props = defineProps({
    contact: {
        type: Object,
        required: true,
    },
});

const form = ref(null);
const formRef = useTemplateRef('form');

const handleSubmit = () => formRef.value.emitValues();

const onSubmit = (values) => {
    emit('edit', values);
    formRef.value.resetForm();
};

</script>
