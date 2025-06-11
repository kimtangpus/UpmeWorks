<script setup lang="ts">
import SimpleButton from '../buttons/SimpleButton.vue';
import CardWithInlineTitle from '../cards/CardWithInlineTitle.vue';
import ModalHeaderTemplate from './modal-templates/ModalHeaderTemplate.vue';
import ModalTemplate from './modal-templates/ModalTemplate.vue';
import DataTable from '../tables/DataTable.vue';


const props = defineProps({
    show: Boolean
})

const emit = defineEmits(['close'])

const handleClose = () => {
    emit('close')
}

// Define table columns
const columns = [
    { key: 'menuDesc', label: 'Menu Description', align: 'center' as const },
    { key: 'qty', label: 'QTY', align: 'center' as const },
]

// Sample data
const tableData = Array.from({ length: 4 }, (_, i) => ({
    menuDesc: 'Lorem ipsum',
    qty: 'Lorem ipsum'
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
                <ModalHeaderTemplate title="Split Table" icon="fas fa-arrows-split-up-and-left" @close="handleClose" />
            </template>

            <template #body>
                <!-- Modal Body -->
                <div class="flex gap-4 px-6 py-4">

                    <!-- Source Table Card -->
                    <CardWithInlineTitle title="Source Table" icon="fas fa-table">
                        <template #body>
                            <div class="flex flex-col px-4">
                                <div class="text-3xl font-bold text-white text-center rounded border border-(--upme-dark-green) bg-(--card-green) py-2 -mx-4">
                                    1,872.00
                                </div>

                                <div class="p-2 w-full">
                                        <DataTable 
                                            :columns="columns"
                                            :data="tableData"
                                            :showSplitBill="true"
                                            @edit="handleEdit"
                                            @delete="handleDelete"
                                        />
                                </div>
                            </div>
                        </template>
                    </CardWithInlineTitle>

                    <!-- Split Table Card -->
                    <CardWithInlineTitle title="Split Table" icon="fas fa-random">
                        <template #body>
                            <div class="flex flex-col px-4">
                                <div class="text-3xl font-bold text-center rounded bg-[#CAE0BC] py-2 -mx-4"
                                    style="color: var(--upme-dark-green); opacity: 0.5;">
                                    0.00
                                </div>

                                <div class="p-2 w-full">
                                        <DataTable 
                                            :columns="columns"
                                            :data="tableData"
                                            @edit="handleEdit"
                                            @delete="handleDelete"
                                        />
                                </div>
                            </div>
                        </template>
                    </CardWithInlineTitle>
                </div>

            </template>

            <template #footer>
                <div class="flex justify-between gap-4 px-12 pb-6 items-center">
                    <!-- Reset Button -->
                    <SimpleButton
                        class="flex-1 border border-yellow-200 bg-yellow-50 text-yellow-700 font-semibold py-2 rounded hover:bg-yellow-100"
                        text="Reset" />

                    <!-- Cancel and Split Buttons -->
                    <div class="flex flex-1 gap-2">
                        <SimpleButton
                            class="w-full border border-gray-300 py-2 rounded hover:bg-gray-100 text-(--upme-dark-green)"
                            text="Cancel" />
                        <SimpleButton
                            class="w-full bg-(--button-green) text-white py-2 rounded hover:bg-(--selected-button-green)"
                            text="Split Table" />
                    </div>
                </div>
            </template>




        </ModalTemplate>
    </Teleport>

</template>