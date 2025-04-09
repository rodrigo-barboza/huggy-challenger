<template>
    <AppModal v-model="model">
        <template #header>
            <div class="flex flex-col items-center gap-4 sm:gap-0 sm:flex-row sm:justify-between">
                <div class="flex items-center gap-4 order-2 sm:order-1">
                    <img
                        class="rounded-full"
                        :src="generateAvatar(contact.name)"
                    >
                    <span class="font-medium text-xl text-[#262626]">{{ contact.name }}</span>
                </div>
                <div class="flex gap-2 order-1 sm:order-2">
                    <div
                        class="cursor-pointer w-[44px] flex items-center justify-center h-full"
                        @click="emit('delete', contact)"
                    >
                        <DeleteIcon />
                    </div>
                    <div
                        class="cursor-pointer w-[44px] flex items-center justify-center h-full"
                        @click="emit('edit', contact)"
                    >
                        <EditIcon />
                    </div>
                    <div
                        v-if="contact.phone"
                        class="cursor-pointer w-[44px] flex items-center justify-center h-full"
                        @click="emit('call', contact)"
                    >
                        <PhoneIcon />
                    </div>
                    <div
                        class="cursor-pointer w-[44px] flex items-center justify-center h-full"
                        @click="model = false"
                    >
                        <CloseIcon />
                    </div>
                </div>
            </div>
        </template>
        <div class="mt-[-8px] flex flex-col gap-4">
            <div
                v-for="({ key, label, value }, index) in values"
                :key="index"
                class="grid grid-cols-12 gap-4 text-[#262626]"
            >
                <template v-if="!fieldsToHidden.includes(key)">
                    <div class="col-span-3 text-right">
                        <p class="text-xs leading-[16px] font-medium tracking-[0.4px]">{{ label }}</p>
                    </div>
                    <div class="col-span-9">
                        <p class="text-sm font-normal tracking-[0.25px]">{{ value ?? '-' }}</p>
                    </div>
                </template>
            </div>
        </div>
    </AppModal>
</template>

<script setup>

const emit = defineEmits(['edit', 'delete']);

const model = defineModel({
    type: Boolean,
    default: false,
});

const props = defineProps({
    contact: {
        type: Object,
        default: () => ({})
    },
});

const { generateAvatar } = useUtils();

const labels = {
    name: 'Nome',
    email: 'Email',
    phone: 'Telefone',
    cellphone: 'Celular',
    address: 'Endereço',
    neighborhood: 'Bairro',
    state: 'Estado',
};

const fieldsToHidden = ['id'];

const values = computed(
    () => Object.entries(props.contact)
        .map(([key, value]) => ({ label: labels[key], value, key }))
);

</script>