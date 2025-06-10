<script setup lang="ts">
import { ref } from 'vue';
import SimpleButton from '../buttons/SimpleButton.vue';
import CardWrapper from '../cards/CardWrapper.vue';
import ReportViewModal from './ReportViewModal.vue';
import ModalHeaderTemplate from './modal-templates/ModalHeaderTemplate.vue';
import ModalTemplate from './modal-templates/ModalTemplate.vue';
import PrintXReportModal from './PrintXReportModal.vue';
import PrintZReportModal from './PrintZReportModal.vue';

type ReportType = 
    'dailySales' | 'salesByCategory' | 'refundEntries' | 'voidItems' | 'serviceCharges' |
    'expenses' | 'eSales' | 'scPWDSummary' | 'menuMasterList' | 'stockRequisList' |
    'stockIssuanceList' | 'storAreaInv' | 'backendSales' | 'BIRsalesSummary';

const showModal = ref(false);
const currentReport = ref<ReportType | null>(null);
const reportTitle = ref('');
const showPrintXReportModal = ref(false);
const showPrintZReportModal = ref(false);

const props = defineProps({
    show: Boolean
})

const emit = defineEmits(['close'])

const handleClose = () => {
    emit('close')
}


const reportTitles: Record<ReportType, string> = {
    dailySales: 'Daily Sales Report',
    salesByCategory: 'Sales By Menu Category',
    refundEntries: 'Refund Entries',
    voidItems: 'Void Items Report',
    serviceCharges: 'Service Charges Report',
    expenses: 'Expenses Report',
    eSales: 'E-Sales Report',
    scPWDSummary: 'SC-PWD Summary Report',
    menuMasterList: 'Menu Masterlist',
    stockRequisList: 'Stock Requisition List',
    stockIssuanceList: 'Stock Issuance List',
    storAreaInv: 'Storage Area Inventory',  //needs a custom toolbar
    backendSales: 'Back-End Sales Report',
    BIRsalesSummary: ' BIR Sales Summary Report',
}

function openModal(reportName: ReportType) {
    currentReport.value = reportName
    reportTitle.value = reportTitles[reportName]
    showModal.value = true
}

function closeReportModal() {
    showModal.value = false
    currentReport.value = null
}

</script>

<template>
    <Teleport to="body">
        <ModalTemplate :show="show" @closeModal="handleClose">
            <template #header>
                <ModalHeaderTemplate title="Miscellaneous Task" description="List of reports for extraction"
                    icon="fas fa-circle-dot" @close="handleClose" />
            </template>

            <template #body>
                <div class="flex flex-col overflow-hidden px-6 py-4">
                    <!-- Grid container -->
                    <div class="grid grid-cols-3 gap-6">
                        <!-- POS Sales Reports -->
                        <CardWrapper class="bg-white border border-gray-100 rounded p-6">
                            <template #header>
                                <h1 class="text-2xl text-(--upme-dark-green) font-bold whitespace-nowrap">POS Sales
                                    Reports</h1>
                            </template>
                            <template #body>
                                <div class="flex flex-col items-start gap-3 text-(--upme-dark-green) whitespace-nowrap">
                                    <SimpleButton class="text-start w-full hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Daily Sales Report" @click="openModal('dailySales')" />
                                    <SimpleButton class="text-start w-full hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Sales By Menu Category" @click="openModal('salesByCategory')" />
                                    <SimpleButton class="text-start w-full hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Refund Entries" @click="openModal('refundEntries')" />
                                    <SimpleButton class="text-start w-full hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Void Items Report" @click="openModal('voidItems')" />
                                    <SimpleButton class="text-start w-full hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Service Charges Report" @click="openModal('serviceCharges')" />
                                </div>
                            </template>
                        </CardWrapper>

                        <!-- Miscellaneous Reports -->
                        <CardWrapper class="bg-white border border-gray-100 rounded p-6">
                            <template #header>
                                <h1 class="text-2xl text-(--upme-dark-green) font-bold whitespace-nowrap">Miscellaneous
                                    Reports</h1>
                            </template>
                            <template #body>
                                <div class="flex flex-col items-start gap-3 text-(--upme-dark-green)">
                                    <SimpleButton class="text-start w-full hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Expenses" @click="openModal('expenses')" />
                                    <SimpleButton class="text-start w-full hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Applied Discounts" />
                                    <SimpleButton class="text-start w-full hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="E-Sales Report" @click="openModal('eSales')" />
                                    <SimpleButton class="text-start w-full hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="SC-PWD Summary Report" @click="openModal('scPWDSummary')" />
                                    <SimpleButton class="text-start w-full hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Audit Trails" />
                                </div>
                            </template>
                        </CardWrapper>

                        <!-- Inventory Reports -->
                        <CardWrapper class="bg-white border border-gray-100 rounded p-6">
                            <template #header>
                                <h1 class="text-2xl text-(--upme-dark-green) font-bold whitespace-nowrap">Inventory
                                    Reports</h1>
                            </template>
                            <template #body>
                                <div class="flex flex-col items-start gap-3 text-(--upme-dark-green)">
                                    <SimpleButton class="text-start w-full hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Menu Masterlist" @click="openModal('menuMasterList')" />
                                    <SimpleButton class="text-start w-full hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Stock Requisition List" @click="openModal('stockRequisList')"  />
                                    <SimpleButton class="text-start w-full hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Stock Issuance List"@click="openModal('stockIssuanceList')" />
                                    <SimpleButton class="text-start w-full hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Storage Area Inventory" @click="openModal('storAreaInv')" />
                                </div>
                            </template>
                        </CardWrapper>

                        <!-- Backend Reports -->
                        <CardWrapper class="bg-white border border-gray-100 rounded p-6">
                            <template #header>
                                <h1 class="text-2xl text-(--upme-dark-green) font-bold whitespace-nowrap">Backend
                                    Reports</h1>
                            </template>
                            <template #body>
                                <div class="flex flex-col items-start gap-3 text-(--upme-dark-green)">
                                    <SimpleButton class="text-start w-full hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="Back-end Sales Report" @click="openModal('backendSales')"  />
                                    <SimpleButton class="text-start w-full hover:bg-gray-200" icon="fas fa-folder-open"
                                        text="BIR Sales Summary Report"  @click="openModal('BIRsalesSummary')"  />
                                </div>
                            </template>
                        </CardWrapper>

                        <!-- Cashier Reports -->
                        <CardWrapper class="bg-white border border-gray-100 rounded p-6">
                            <template #header>
                                <h1 class="text-2xl text-(--upme-dark-green) font-bold whitespace-nowrap">Cashier
                                    Reports</h1>
                            </template>
                            <template #body>
                                <div class="flex flex-col items-start gap-3 text-(--upme-dark-green)">
                                    <SimpleButton 
                                        class="text-start w-full hover:bg-gray-200" 
                                        icon="fas fa-folder-open"
                                        text="Print X-Reading"
                                        @click="showPrintXReportModal = true" />
                                    <SimpleButton 
                                        class="text-start w-full hover:bg-gray-200" 
                                        icon="fas fa-folder-open"
                                        text="Print Z-Reading"
                                        @click="showPrintZReportModal = true" />
                                </div>
                            </template>
                        </CardWrapper>

                        <!-- Utilities -->
                        <CardWrapper class="bg-white border border-gray-100 rounded p-6">
                            <template #header>
                                <h1 class="text-2xl text-(--upme-dark-green) font-bold whitespace-nowrap">Utilities</h1>
                            </template>
                            <template #body>
                                <div class="flex flex-col items-start gap-3 text-(--upme-dark-green)">
                                    <SimpleButton class="text-start w-full hover:bg-gray-200" icon="fas fa-gear"
                                        text="Void Transaction" />
                                    <SimpleButton class="text-start w-full hover:bg-gray-200" icon="fas fa-gear"
                                        text="Open Locked Tables" />
                                </div>
                            </template>
                        </CardWrapper>
                    </div>
                </div>

                <!-- Used for all reports -->
                <ReportViewModal 
                    v-if="showModal && currentReport" 
                    :show="showModal"
                    :title="reportTitle"
                    @close="closeReportModal" 
                />

                <PrintXReportModal :show="showPrintXReportModal" @close="showPrintXReportModal = false"/>
                <PrintZReportModal :show="showPrintZReportModal" @close="showPrintZReportModal = false" />

            </template>
        </ModalTemplate>
    </Teleport>
</template>