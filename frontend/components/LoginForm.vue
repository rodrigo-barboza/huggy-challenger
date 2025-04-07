<template>
    <form @submit.prevent="onSubmit" class="space-y-4">
        <div class="flex flex-col gap-4">
            <TextInput
                class="col-span-2"
                v-model="email.value.value"
                label="Email"
                placeholder="Email"
                :field="email"
            />
            <TextInput
                class="col-span-2"
                v-model="password.value.value"
                type="password"
                label="Senha"
                placeholder="Digite sua senha"
                :field="password"
            />
        </div>
        <div class="flex justify-center">
            <SecondaryButton
                class="w-fit"
                type="submit"
            >
                Entrar
            </SecondaryButton>
        </div>
    </form>
</template>

<script setup>
import * as yup from 'yup';

const emit = defineEmits(['submit']);

const schema = yup.object({
    email: yup.string().required('Email é obrigatório').email('Digite um email válido'),
    password: yup.string().required('Senha é obrigatório'),
});

const { handleSubmit, resetForm } = useForm({ validationSchema: schema });

const email = useField('email');
const password = useField('password');

const onSubmit = handleSubmit((values) => emit('submit', values));

defineExpose({ resetForm });
</script>
