<template>
    <section class="flex flex-col border-l border-gray-200 h-full bg-white w-full max-w-md">
        <div class="flex-shrink-0 p-4">
            <div class="text-sm text-(--upme-dark-green) font-medium flex justify-between mb-2">
                <span>Transaction No.: 000000000000</span>
                <span>Table No.: 25</span>
            </div>

            <div class="bg-gray-100 p-4 rounded-xl shadow-inner">
                <div class="bg-[#343434] text-[#FFFFFF] text-center py-6 rounded-xl text-5xl font-bold shadow">
                    ₱{{ payableAmount.toFixed(2) }}
                </div>
            </div>
        </div>

        <!-- ordered items -->
        <div class="flex-1 overflow-y-auto p-4">
            <div class="space-y-2">
                <div v-for="(item, idx) in orderItems" :key="item.id"
                    class="bg-white rounded-xl shadow p-3 bg-[#f6fbf2] flex flex-col gap-2">

                    <div class="flex justify-between items-start">
                        <div class="font-semibold text-(--upme-dark-green) text-lg font-bold">{{ item.name }}</div>
                        <div class="flex items-center text-lg">

                            <ButtonIcon icon="fas fa-pencil" title=""
                                class="text-gray-500 hover:text-blue-600 focus:outline-none" />

                            <ButtonIcon icon="fas fa-certificate" title=""
                                class="text-gray-500 hover:text-blue-600 focus:outline-none" />

                            <ButtonIcon icon="fas fa-tag" title="Override Price" @click="showOverridePriceModal = true"
                                class="text-gray-500 hover:text-yellow-600 focus:outline-none" />

                            <ButtonIcon icon="fas fa-trash" title="Remove Item" @click="$emit('remove-item', idx)"
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

                <SimpleButton class="flex-1 bg-[#87b46f] text-white py-2 rounded-lg font-semibold hover:bg-[#7ca460]"
                    @click="$emit('void-order')" text="Send Order Slip" />

                <SimpleButton class="flex-1 bg-[#87b46f] text-white py-2 rounded-lg font-semibold hover:bg-[#7ca460]"
                    @click="$emit('proceed')" text="Print Bill" />

            </div>
        </div>
    </section>

    <OverridePriceModal :show="showOverridePriceModal" @close="showOverridePriceModal = false" />

    <PaymentModal v-if="showPaymentModal" :grandTotal="payableAmount" @close="showPaymentModal = false"
        @payment-confirmed="$emit('payment-confirmed', $event)" />

    <BillOut v-if="showBillOut" :orderItems="orderItems" :paidAmount="paidAmount" :changeAmount="changeAmount"
        @close="showBillOut = false" @confirm-payment="$emit('confirm')" />
</template>

<script setup lang="ts">
import { ref } from 'vue'
import BillOut from '@/components/BillOut.vue'
import PaymentModal from '@/components/PaymentModal.vue'
import OverridePriceModal from './ui/modals/OverridePriceModal.vue'
import ButtonIcon from './ui/buttons/ButtonIcon.vue'
import SimpleButton from './ui/buttons/SimpleButton.vue'

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
    }
})

const showPaymentModal = ref(false)
const showBillOut = ref(false)
const showOverridePriceModal = ref(false)
const paidAmount = ref(0)
const changeAmount = ref(0)

defineEmits<{
    (e: 'update-item-qty', item: OrderItem, newQty: number): void
    (e: 'remove-item', index: number): void
    (e: 'void-order'): void
    (e: 'proceed'): void
    (e: 'payment-confirmed', data: { paid: number, change: number }): void
    (e: 'confirm'): void
}>()
</script>