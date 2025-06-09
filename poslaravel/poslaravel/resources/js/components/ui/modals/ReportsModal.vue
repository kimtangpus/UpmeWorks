<script setup lang="ts">
import SimpleButton from '../buttons/SimpleButton.vue';
import CardWrapper from '../cards/CardWrapper.vue';
import ModalHeaderTemplate from './modal-templates/ModalHeaderTemplate.vue';
import ModalTemplate from './modal-templates/ModalTemplate.vue';


const props = defineProps({
    show: Boolean
})

const emit = defineEmits(['close'])

const handleClose = () => {
    emit('close')
}

</script>

<template>
    <Teleport to="body">
        <ModalTemplate :show="show" @closeModal="handleClose">
            <template #header>
                <ModalHeaderTemplate title="Miscellaneous Task" description="List of reports for extraction" icon="fas fa-circle-dot"
                    @close="handleClose" />
            </template>

            <template #body>
                <div class="flex flex-col overflow-hidden">
                    <!-- first row -->
                    <div class="flex flex-row gap-4">
                        <CardWrapper class="flex-1 basis-1/3 bg-white border border-gray-100 rounded">
                            <template #header>
                                <h1 class="text-2xl text-(--upme-dark-green) font-bold whitespace-nowrap">POS Sales
                                    Reports</h1>
                            </template>
                            <template #body>
                                <div class="flex flex-col items-start gap-2 text-(--upme-dark-green)">
                                    <SimpleButton class="hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Daily Sales Report" />
                                    <SimpleButton class="hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Sales By Menu Category" />
                                    <SimpleButton class="hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Refund Entries" />
                                    <SimpleButton class="hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Void Items Report" />
                                    <SimpleButton class="hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Service Charges Report" />
                                </div>
                            </template>
                        </CardWrapper>

                        <CardWrapper class="flex-1 basis-1/3 bg-white border border-gray-100 rounded">
                            <template #header>
                                <h1 class="text-2xl text-(--upme-dark-green) font-bold whitespace-nowrap">Miscellaneous
                                    Reports</h1>
                            </template>
                            <template #body>
                                <div class="flex flex-col items-start gap-2 text-(--upme-dark-green)">
                                    <SimpleButton class="hover:bg-gray-200" icon="fas fa-folder-open" text="Expenses" />
                                    <SimpleButton class="hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Applied Discounts" />
                                    <SimpleButton class="hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="E-Sales Report" />
                                    <SimpleButton class="hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="SC-PWD Summary Report" />
                                    <SimpleButton class="hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Audit Trails" />
                                </div>
                            </template>
                        </CardWrapper>

                        <CardWrapper class="flex-1 basis-1/3 bg-white border border-gray-100 rounded">
                            <template #header>
                                <h1 class="text-2xl text-(--upme-dark-green) font-bold whitespace-nowrap">Inventory
                                    Reports</h1>
                            </template>
                            <template #body>
                                <div class="flex flex-col items-start gap-2 text-(--upme-dark-green)">
                                    <SimpleButton class="hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Menu Masterlist" />
                                    <SimpleButton class="hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Stock Requisition List" />
                                    <SimpleButton class="hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Stock Issuance List" />
                                    <SimpleButton class="hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Storage Area Inventory" />
                                </div>
                            </template>
                        </CardWrapper>
                    </div>

                    <!-- second row -->
                    <div class="flex flex-row gap-4 mt-4">
                        <CardWrapper class="flex-1 basis-1/3 bg-white border border-gray-100 rounded">
                            <template #header>
                                <h1 class="text-2xl text-(--upme-dark-green) font-bold whitespace-nowrap">Backend
                                    Reports</h1>
                            </template>
                            <template #body>
                                <div class="flex flex-col items-start gap-2 text-(--upme-dark-green)">
                                    <SimpleButton class="hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Back-end Sales Report" />
                                    <SimpleButton class="hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="BIR Sales Summary Report" />
                                </div>
                            </template>
                        </CardWrapper>

                        <CardWrapper class="flex-1 basis-1/3 bg-white border border-gray-100 rounded">
                            <template #header>
                                <h1 class="text-2xl text-(--upme-dark-green) font-bold whitespace-nowrap">Cashier
                                    Reports</h1>
                            </template>
                            <template #body>
                                <div class="flex flex-col items-start gap-2 text-(--upme-dark-green)">
                                    <SimpleButton class="hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Print X-Reading" />
                                    <SimpleButton class="hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Print Z-Reading" />
                                </div>
                            </template>
                        </CardWrapper>

                        <CardWrapper class="flex-1 basis-1/3 bg-white border border-gray-100 rounded">
                            <template #header>
                                <h1 class="text-2xl text-(--upme-dark-green) font-bold whitespace-nowrap">Utilities</h1>
                            </template>
                            <template #body>
                                <div class="flex flex-col items-start gap-2 text-(--upme-dark-green)">
                                    <SimpleButton class="hover:bg-gray-200" icon="fas fa-gear"
                                        text="Void Transaction" />
                                    <SimpleButton class="hover:bg-gray-200" icon="fas fa-gear"
                                        text="Open Locked Tables" />
                                </div>
                            </template>
                        </CardWrapper>
                    </div>
                </div>
            </template>



        </ModalTemplate>
    </Teleport>
</template>