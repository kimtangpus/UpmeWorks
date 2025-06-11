<template>
    <!-- temp solution since ordered items doesn't want to be scrollable: overflow-y-auto -->
    <section class="flex flex-col border-l border-gray-200 bg-white h-full max-h-md overflow-y-auto">
        <div class="flex flex-col p-4">
            <div class="text-sm text-(--upme-dark-green) font-medium flex justify-between mb-2">
                <span>Transaction No.: 000000000000</span>
                <span>Table No.: 25</span>
            </div>

            <div class="bg-gray-100 p-2 rounded shadow-inner flex flex-col">
                <!-- Price Banner -->
                <div class="bg-[#343434] text-[#FFFFFF] text-center py-6 rounded text-5xl font-bold shadow">
                    ₱{{ payableAmount.toFixed(2) }}
                </div>

                <!-- ordered items -->
                <div class="overflow-x-auto p-2 space-y-2 flex-1">
                    <div class="space-y-2">
                        <div v-for="(item, idx) in orderItems" :key="item.id"
                            class="bg-white rounded shadow p-3 bg-[#f6fbf2] flex flex-col gap-2">

                            <div class="flex justify-between items-start">
                                <div class="font-semibold text-(--upme-dark-green) text-lg font-bold">{{ item.name }}
                                </div>
                                <div class="flex items-center text-lg">

                                    <ButtonIcon icon="fas fa-pencil" title=""
                                        class="text-gray-500 hover:text-blue-600 focus:outline-none" />

                                    <ButtonIcon icon="fas fa-certificate" title=""
                                        class="text-gray-500 hover:text-blue-600 focus:outline-none" />

                                    <ButtonIcon icon="fas fa-tag" title="Override Price"
                                        @click="showOverridePriceModal = true"
                                        class="text-gray-500 hover:text-yellow-600 focus:outline-none" />

                                    <ButtonIcon icon="fas fa-trash" title="Remove Item"
                                        @click="$emit('remove-item', idx)"
                                        class="text-gray-500 hover:text-red-600 focus:outline-none text-lg" />

                                </div>
                            </div>

                            <!-- Bottom Row: Quantity Controls -->
                            <div class="flex items-center justify-between text-sm text-gray-600">
                                <div class="flex items-center gap-2 text-[--upme-dark-green] font-bold">
                                    <button @click="$emit('update-item-qty', item, item.quantity - 1)"
                                        :disabled="item.quantity === 1" class="w-6 h-6 flex items-center justify-center rounded
                                            bg-gray-200 hover:bg-gray-300
                                            disabled:opacity-50 disabled:cursor-not-allowed" title="Decrease">
                                        −
                                    </button>

                                    <span class="w-6 text-center">{{ item.quantity }}</span>

                                    <button @click="$emit('update-item-qty', item, item.quantity + 1)"
                                        class="w-6 h-6 flex items-center justify-center bg-gray-200 hover:bg-gray-300 rounded"
                                        title="Increase">
                                        +
                                    </button>
                                </div>

                                <div class="text-sm font-bold text-(--button-green)">
                                    ₱{{ (item.price * item.quantity).toFixed(2) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="flex-shrink-0 p-4">
            <div class="bg-(--upme-light-green) rounded-xl p-4 shadow-inner text-(--upme-dark-green)">
                <div class="grid grid-cols-2 gap-x-6 gap-y-4">
                    <div class="flex justify-between">
                        <span class="font-bold text-md">Total:</span>
                        <span class="font-medium text-md">₱{{ payableAmount.toFixed(2) }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="font-bold text-md">Payments:</span>
                        <span class="font-medium text-md">₱0.00</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="font-bold text-md">Discount:</span>
                        <span class="font-medium text-md">₱{{ discountTotal.toFixed(2) }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="font-bold text-md">Service Charge:</span>
                        <span class="font-medium text-md">₱{{ serviceCharge.toFixed(2) }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="font-bold text-md">Subtotal:</span>
                        <span class="font-medium text-md">₱{{ subtotal.toFixed(2) }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="font-bold text-md">Other Charges:</span>
                        <span class="font-medium text-md">₱0.00</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-between gap-2 mt-4">
                <SimpleButton class="flex-1 bg-[#87b46f] text-white py-2 rounded-lg font-semibold hover:bg-[#7ca460]"
                    @click="$emit('void-order')" text="Void" />

                <SimpleButton 
                    class="flex-1 bg-[#87b46f] text-white py-2 rounded-lg font-semibold hover:bg-[#7ca460]"
                    text="Send Order Slip" 
                     />

                <SimpleButton class="flex-1 bg-[#87b46f] text-white py-2 rounded-lg font-semibold hover:bg-[#7ca460]"
                    text="Print Bill"
                    @click="showPrintBillModal = true"
                     />

            </div>
        </div>
    </section>

    <OverridePriceModal :show="showOverridePriceModal" @close="showOverridePriceModal = false" />

    <PrintBillModal :show="showPrintBillModal" @close="showPrintBillModal = false" />

</template>

<script setup lang="ts">
import { ref } from 'vue'
import OverridePriceModal from './ui/modals/OverridePriceModal.vue'
import ButtonIcon from './ui/buttons/ButtonIcon.vue'
import SimpleButton from './ui/buttons/SimpleButton.vue'
import PrintBillModal from './ui/modals/PrintBillModal.vue'

interface OrderItem {
    id: number
    name: string
    price: number
    quantity: number
    discount: number
    total: number
}

defineProps({
    orderItems: {
        type: Array as () => OrderItem[],
        required: true
    },
    subtotal: {
        type: Number,
        required: true
    },
    discountTotal: {
        type: Number,
        required: true
    },
    tax: {
        type: Number,
        required: true
    },
    serviceCharge: {
        type: Number,
        required: true
    },
    payableAmount: {
        type: Number,
        required: true
    },
    showPaymentModal : {
        type: Boolean, 
        default: false
    },
    showBillOut : {
        type: Boolean, 
        default: false
    },
    paidAmount : {
        type: Number, 
        default: 0
    },
    changeAmount : {
        type: Number, 
        default: 0
    },

})

const showOverridePriceModal = ref(false)
const showPrintBillModal = ref(false)

defineEmits<{
    (e: 'update-item-qty', item: OrderItem, newQty: number): void
    (e: 'remove-item', index: number): void
    (e: 'void-order'): void
    (e: 'proceed'): void
    (e: 'payment-confirmed', data: { paid: number, change: number }): void
    (e: 'confirm'): void
}>()
</script>