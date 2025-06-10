<template>
    <div>
        <nav
            class="bg-white shadow-md border-grey-200 fixed bottom-[32px] left-0 w-full z-50 flex flex-wrap justify-center text-(--upme-dark-green) p-2 gap-4">
            <BottomMenuButton icon="fas fa-circle-play" label="Start Day" />
            <BottomMenuButton icon="fas fa-stop" label="End Day" />
            <BottomMenuButton href="/show-orders" icon="fas fa-file-invoice-dollar" label="Show Orders" />
            <BottomMenuButton 
                icon="fas fa-percent" 
                label="Apply Discount" 
                @click="showApplyDiscountModal = true" />
            
                <BottomMenuButton 
                icon="fas fa-cash-register" 
                label="Bill Out"
                @click="showBillOutModal = true" />

            <!-- change href of this when functionality is added -->
            <BottomMenuButton href="/show-orders" icon="fas fa-arrow-down-up-across-line" label="Transfer Table" />
            <BottomMenuButton 
                icon="fas fa-file-invoice-dollar" 
                label="Refunds" 
                @click="showRefundListModal = true" />

            <BottomMenuButton 
                icon="fas fa-divide" 
                label="Split Bill"
                @click="showSplitBillModal = true" />

            <BottomMenuButton icon="fas fa-print" label="Print X-Report" />
            <BottomMenuButton icon="fas fa-print" label="Print Z-Report" />
            
            <BottomMenuButton 
                icon="fas fa-file" 
                label="Reports" 
                @click="showReportsModal = true" />

                <BottomMenuButton 
                    icon="fas fa-clipboard" 
                    label="Back Office"
                    @click="showBackOfficePopover = true" />
        </nav>


        <ApplyDiscountModal :show="showApplyDiscountModal" @close="showApplyDiscountModal = false" />

        <BillOutModal :show="showBillOutModal" @close="showBillOutModal = false" />

        <RefundListModal :show="showRefundListModal" @close="showRefundListModal = false" />

        <SplitBillModal :show="showSplitBillModal" @close="showSplitBillModal = false" />
    
        <ReportsModal :show="showReportsModal" @close="showReportsModal = false" />

        <BackOfficePopover :show="showBackOfficePopover" @close="showBackOfficePopover = false" />
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import BottomMenuButton from '@/components/ui/bottom-menu/BottomMenuButton.vue';
import ApplyDiscountModal from './ui/modals/ApplyDiscountModal.vue';
import RefundListModal from './ui/modals/RefundListModal.vue';
import ReportsModal from './ui/modals/ReportsModal.vue';
import SplitBillModal from './ui/modals/SplitBillModal.vue';
import BillOutModal from './ui/modals/BillOutModal.vue';
import BackOfficePopover from './ui/popovers/BackOfficePopover.vue';

const showApplyDiscountModal = ref(false);
const showRefundListModal = ref(false);
const showReportsModal = ref(false);
const showSplitBillModal = ref(false);
const showBillOutModal = ref(false);
const showBackOfficePopover = ref(false);

</script>