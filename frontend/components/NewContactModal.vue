<template>
    <AppModal
        v-model="model"
        title="Adicionar novo contato"
    >
        <NewContactForm
            ref="form"
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

const model = defineModel({
    type: Boolean,
    default: false,
});

const form = ref(null);
const formRef = useTemplateRef('form');

const handleSubmit = () => formRef.value.emitValues();

const onSubmit = (values) => {
    console.log('Dados do formulário:', values);
    formRef.value.resetForm();
};

</script>
