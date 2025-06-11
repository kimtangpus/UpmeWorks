<script setup lang="ts">
import { ref } from 'vue';
import ModalTemplate from './modal-templates/ModalTemplate.vue';
import ButtonIcon from '../buttons/ButtonIcon.vue';
import SimpleButton from '../buttons/SimpleButton.vue';
import DataTable from '../tables/DataTable.vue';
import ModalHeaderTemplate from './modal-templates/ModalHeaderTemplate.vue';

const props = defineProps({
    show: Boolean
})

const emit = defineEmits(['close'])

const handleClose = () => {
    emit('close')
}

// Define table columns
const columns = [
    { key: 'transNo', label: 'Trans No.', align: 'left' as const },
    { key: 'docDate', label: 'Doc Date', align: 'left' as const },
    { key: 'amount', label: 'Amount', align: 'left' as const }
]

// Sample data
const tableData = Array.from({ length: 12 }, (_, i) => ({
    transNo: 'Lorem ipsum',
    docDate: 'Lorem ipsum',
    amount: 'Lorem ipsum'
}))

const handleEdit = (item: any, index: number) => {
    console.log('Edit item:', item, 'at index:', index)
}

const handleDelete = (item: any, index: number) => {
    console.log('Delete item:', item, 'at index:', index)
}
</script>

<template>
    <Teleport to="body">
        <ModalTemplate :show="show" @closeModal="handleClose">
            <template #header>
                <ModalHeaderTemplate title="Refund List" description="Add/edit record information"
                    icon="fas fa-certificate" @close="handleClose" />
            </template>
            <template #body>
                <div class="flex flex-col gap-2">
                    <div class="flex justify-between items-center text-[var(--upme-dark-green)] space-x-4">
                        <SimpleButton
                            class="p-2 rounded-lg bg-white hover:bg-gray-100 shadow transition flex items-center gap-2 cursor-pointer"
                            text="Add new item" icon="fas fa-plus" />
                        <div class="relative w-1/2">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input value="" type="text" placeholder="Search here"
                                class="p-2 pl-10 border border-[#d0e0cd] rounded-xl w-full shadow-sm focus:outline-none text-[#2e3c2f]" />
                        </div>
                    </div>

                    <div class="rounded-xl border-gray-200">
                        <DataTable 
                            :columns="columns"
                            :data="tableData"
                            :showActions="true"
                            :showEdit="true"
                            :showDelete="true"
                            @edit="handleEdit"
                            @delete="handleDelete"
                        />
                    </div>
                </div>
            </template>
        </ModalTemplate>
    </Teleport>
</template>