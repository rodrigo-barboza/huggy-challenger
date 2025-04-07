<template>
    <div class="min-w-[250px] relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <SearchIcon />
        </div>
        <input
            v-model="searchQuery"
            class="block w-full text-sm font-normal pl-10 pr-3 py-2 border border-[#E1E1E1] rounded-lg bg-[#F8F8F8] focus:outline-none text-[#949494] placeholder-[#949494] transition duration-150"
            placeholder="Buscar contato"
            type="text"
        />
    </div>
</template>

<script setup>

const emit = defineEmits(['filter']);

const searchQuery = ref('');
const searchTimeout = ref(null);

watch(searchQuery, (newValue) => {
    clearTimeout(searchTimeout.value);

    searchTimeout.value = setTimeout(() => {
        emit('filter', newValue);
    }, 500);
});

</script>
