<template>
    <form class="space-y-4">
        <div class="grid grid-cols-3 gap-4">
            <TextInput class="col-span-2" v-model="name.value.value" label="Name" placeholder="Nome completo" :field="name" />
            <TextInput class="col-span-2" v-model="email.value.value" label="Email" placeholder="Email" :field="email" />
        </div>
        <div class="grid grid-cols-2 gap-4">
            <TextInput v-model="phone.value.value" label="Telefone" placeholder="Telefone" :field="phone" />
        </div>
        <div class="grid grid-cols-2  gap-4">
            <TextInput v-model="cellphone.value.value" label="Celular" placeholder="Celular" :field="cellphone" />
        </div>
        <div class="grid grid-cols-6 gap-4">
            <TextInput class="col-span-5" v-model="address.value.value" label="Endereço" placeholder="Endereço" :field="address" />
        </div>
        <div class="grid grid-cols-6 gap-4">
            <TextInput class="col-span-3" v-model="neighborhood.value.value" label="Bairro" placeholder="Bairro" :field="neighborhood" />
            <TextInput class="col-span-2" v-model="state.value.value" label="Estado" placeholder="Estado" :field="state" />
        </div>
    </form>
</template>

<script setup>
import * as yup from 'yup';

const emit = defineEmits(['form-values']);

const props = defineProps({
    contact: {
        type: Object,
        required: true,
    },
});

const schema = yup.object({
    name: yup.string().required('Nome é obrigatório').min(3, 'Mínimo de 3 caracteres').matches(/^[a-zA-ZÀ-ÿ\s]*$/, 'Apenas letras são permitidas'),
    email: yup.string().required('Email é obrigatório').email('Digite um email válido'),
    phone: yup.string().required('Telefone é obrigatório').min(10, 'Mínimo de 10 caracteres'),
    cellphone: yup.string().required('Celular é obrigatório').min(11, 'Mínimo de 11 caracteres'),
    address: yup.nullable,
    neighborhood: yup.nullable,
    state: yup.nullable,
});

const { handleSubmit, resetForm } = useForm({
    validationSchema: schema,
    initialValues: props.contact,
});

const name = useField('name');
const email = useField('email');
const phone = useField('phone');
const cellphone = useField('cellphone');
const address = useField('address');
const neighborhood = useField('neighborhood');
const state = useField('state');

const emitValues = handleSubmit((values) => emit('form-values', values));

defineExpose({ emitValues, resetForm });
</script>
