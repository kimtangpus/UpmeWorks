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
    { key: 'particulars', label: 'Particulars', align: 'center' as const },
    { key: 'rate', label: 'Rate', align: 'center' as const },
    { key: 'qty', label: 'Qty', align: 'center' as const },
    { key: 'amount', label: 'Amount', align: 'center' as const }
]

// Sample data
const tableData = Array.from({ length: 8 }, (_, i) => ({
    particulars: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
    rate: 'Lorem ipsum',
    qty: 'Lorem ipsum',
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
                <ModalHeaderTemplate title="Other Charges" description="Input additional charges such as leftover fees, overstay penalties, etc."
                    icon="fas fa-book" @close="handleClose" />
            </template>
            <template #body>
                <div class="flex flex-col gap-2">
                    <div class="flex items-center justify-between w-full p-2 bg-white text-gray-400 px-6">
                        <!-- Toolbar -->
                        <div class="flex items-center gap-2 w-full">
                            <!-- Dropdown -->
                            <select class="w-full px-3 py-1 text-sm border border-gray-200 rounded focus:outline-none bg-[#FBFBFB] h-[36px]">
                                <option disabled selected>Choose</option>
                                <option>Option 1</option>
                                <option>Option 2</option>
                            </select>

                            <!-- Quantity -->
                            <input
                                type="number"
                                class="w-12 border border-gray-200 border-b-6 rounded px-2 py-1 text-sm focus:outline-none bg-[#FBFBFB]"
                                placeholder="0"
                            />

                            <!-- Unit Price -->
                            <input
                                type="number"
                                step="0.01"
                                class="w-20 border border-gray-200 border-b-6 rounded px-2 py-1 text-sm focus:outline-none bg-[#FBFBFB]"
                                placeholder="0.00"
                            />

                            <!-- Total -->
                            <input
                                type="number"
                                step="0.01"
                                class="w-20 border border-gray-200 border-b-6 rounded px-2 py-1 text-sm focus:outline-none bg-[#FBFBFB]"
                                placeholder="0.00"
                            />
                            
                            <!-- Add Button -->
                            <ButtonIcon 
                                class="text-(--upme-dark-green) text-2xl hover:bg-gray-200 py-0.5"
                                title="Add" 
                                icon="fas fa-file-circle-plus"  
                            />
                        </div>
                    </div>

                    <div class="px-6">
                        <DataTable 
                            :columns="columns"
                            :data="tableData"
                            @edit="handleEdit"
                            @delete="handleDelete"
                        />
                    </div>
                    
                    <div class="px-6 mt-4">
                            <SimpleButton type="submit"
                                class="w-full text-white bg-(--button-green) hover:bg-(--selected-button-green) focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center transition-all"
                                v-motion :initial="{ opacity: 0, y: 20 }"
                                :enter="{ opacity: 1, y: 0, transition: { duration: 300, delay: 300 } }"
                                :hover="{ scale: 1.02 }" :tap="{ scale: 0.98 }" 
                                text="Confirm" 
                            />
                    </div>
                </div>
            </template>
        </ModalTemplate>
    </Teleport>
</template>