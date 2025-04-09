<template>
    <div class="overflow-x-auto">
        <table class="w-full min-w-[600px]">
            <thead class="font-medium text-[#505050] text-xs">
                <tr>
                    <th
                        v-for="({ name, label, sortable = false }, index) in fields"
                        class="py-[13px] px-3 sm:px-6"
                        :class="{ 'cursor-pointer': sortable }"
                        :key="index"
                        @click="sortable && sortFields(name)"
                    >
                        <div class="flex justify-start items-center gap-1 leading-[16px] tracking-[0.4px]">
                            <span class="whitespace-nowrap">
                                {{ label }}
                            </span>
                            <template v-if="sortable">
                                <ArrowUpIcon v-if="sortAsc" />
                                <ArrowDownIcon v-else />
                            </template>
                        </div>
                    </th>
                    <th class="w-[100px]"></th>
                </tr>
            </thead>
            <tbody class="border-t border-[#E1E1E1] text-sm text-[#262626] font-normal">
                <tr
                    v-for="item in internalItems"
                    class="hover:bg-[#F8F8F8] cursor-pointer"
                    :key="item.id"
                    @mouseenter="handleHoverActions(true, item.id)"
                    @mouseleave="handleHoverActions(false, item.id)"
                    @click.stop="emit('item-click', item)"
                >
                    <td
                        v-for="({ name }, index) in fields"
                        class="h-[64px] px-3 sm:px-6"
                        :key="index"
                    >
                        <div class="flex items-center">
                            <slot
                                v-if="hasSlots($slots, name)"
                                :name="name"
                                :item="item"
                            />
                            <div v-else class="truncate max-w-[150px] sm:max-w-none">
                                {{ item[name] ?? '-' }}
                            </div>
                        </div>
                    </td>
                    <td class="min-w-[100px] flex justify-end h-[64px] items-center mr-6">
                       <slot
                            v-if="showActions && currentLineId === item.id"
                            name="actions"
                            :item="item"
                        />
                    </td>
                </tr>
            </tbody>
        </table>
        <div
            v-if="internalItems.length === 0"
            class="mt-12 py-[100px] flex justify-center items-center"
        >
            <EmptyState
                title="Ainda não há contatos"
                image="/images/empty-state.png"
                action-text="Adicionar contato"
                @click="emit('open-new-contact-modal')"
            />
        </div>
    </div>
</template>

<script setup>

const emit = defineEmits(['item-click', 'open-new-contact-modal']);

const { hasSlots, sortTable } = useUtils();

const props = defineProps({
    fields: {
        type: Array,
        default: () => ([]),
        required: true,
    },

    items: {
        type: Array,
        default: () => ([]),
        required: true,
    },
});

const internalItems = ref([]);
const sortAsc = ref(true);
const showActions = ref(false);
const currentLineId = ref(null);

watch(() => props.items, (newValue, oldValue) => {
    if (newValue !== oldValue) {
        internalItems.value = props.items;
    }
}, { immediate: true });

const sortFields = (field) => {
    internalItems.value = sortTable(internalItems.value, field, sortAsc.value);
    sortAsc.value = !sortAsc.value;
};

const handleHoverActions = (show, id) => {
    showActions.value = show;
    currentLineId.value = id;
};

</script>

