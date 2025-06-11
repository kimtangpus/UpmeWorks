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
    { key: 'number', label: '#', align: 'center' as const },
    { key: 'particulars', label: 'Particulars', align: 'center' as const },
    { key: 'qty', label: 'Qty', align: 'center' as const },
    { key: 'status', label: 'Status', align: 'center' as const }
]

// Sample data
const tableData = Array.from({ length: 12 }, (_, i) => ({
    number: i + 1,
    particulars: 'Lorem ipsum',
    qty: 'Lorem ipsum',
    status: 'Lorem ipsum'
}))
</script>

<template>
    <Teleport to="body">
        <ModalTemplate :show="show" @closeModal="handleClose">
            <template #header>
                <ModalHeaderTemplate title="Send Order Slip" description="Send orders to designated printers"
                    icon="fas fa-file-invoice-dollar" @close="handleClose" />
            </template>
            <template #body>
                <div class="flex flex-col gap-2">
                    <div class="rounded-xl border-gray-200 w-[600px]">
                        <DataTable 
                            :columns="columns"
                            :data="tableData"
                            :showActions="false"
                        />
                    </div>

                    <div class="rounded p-4 w-2/3">
                        <h4 class="text-sm font-semibold text-[var(--upme-dark-green)] mb-2">Customer Special Request</h4>
                        <textarea 
                            class="w-full p-2 border border-gray-300 rounded-lg text-sm text-[var(--upme-dark-green)] focus:outline-none focus:border-[var(--upme-dark-green)]"
                            rows="3"
                            placeholder="Enter customer's special requests here..."></textarea>
                    </div>

                    <div class="flex justify-end">
                        <SimpleButton 
                            class="bg-(--button-green) text-white px-6 py-2 rounded-lg hover:bg-(--selected-button-green) transition-colors w-full"
                            text="Confirm" />
                    </div>
                </div>
            </template>
        </ModalTemplate>
    </Teleport>
</template>