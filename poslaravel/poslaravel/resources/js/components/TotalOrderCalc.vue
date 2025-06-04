<template>

    <section class="w-1/3 bg-white p-4 rounded-2xl shadow flex flex-col text-[#2e3c2f] h-[calc(100vh-120px)]">

        <div class="text-xs flex justify-between mb-2 text-gray-600">
        <span>Transaction No.: 000000000000</span>
        <span>Table No.: 25</span>
        </div>

        <div class="bg-gray-100 p-4 rounded-xl shadow-inner flex flex-col gap-4 flex-1 min-h-0">

            <div class="shrink-0 bg-black text-[#FFFFFF] text-center py-6 rounded-xl text-5xl font-bold shadow">
                ₱{{ payableAmount.toFixed(2) }}
            </div>

            <div class="flex-1 overflow-y-auto space-y-2 pr-2 min-h-0">
                <div
                v-for="(item, idx) in orderItems"
                :key="item.id"
                class="border rounded-xl shadow p-3 bg-[#f6fbf2] "
                >
                <div class="flex justify-between items-center">
                    <div class="font-semibold text-green-700">{{ item.name }}</div>
                    <div class="text-sm font-bold text-[#87b46f] ">
                    ₱{{ (item.price * item.quantity).toFixed(2) }}
                    </div>
                </div>

                <div class="flex items-center justify-between mt-2 text-sm text-gray-600">
                    <div class="flex items-center gap-2">
                    <button
                        @click="item.quantity > 1 && $emit('update-item-qty', item, item.quantity - 1)"
                        class="w-6 h-6 flex items-center justify-center bg-gray-200 hover:bg-gray-300 "
                    >−</button>
                    <span class="w-6 text-center">{{ item.quantity }}</span>
                    <button
                        @click="$emit('update-item-qty', item, item.quantity + 1)"
                        class="w-6 h-6 flex items-center justify-center bg-gray-200 hover:bg-gray-300 "
                    >+</button>
                    </div>
                    <button @click="$emit('remove-item', idx)" class=" text-xs hover:underline">🗑️</button>
                </div>
                </div>
            </div>
            
        </div>

        <div class="bg-[#cde4b2] text-sm rounded-xl p-4 mt-4 space-y-2 shadow-inner text-green-700">
            <div class="flex justify-between">
                <div class="font-semibold">Total:</div>
                <div></div>
            </div>
            <div class="flex justify-between">
                <span>Discount:</span>
                <span>₱{{ discountTotal.toFixed(2) }}</span>
            </div>
            <div class="flex justify-between">
                <span>Sub total:</span>
                <span>₱{{ subtotal.toFixed(2) }}</span>
            </div>
            <div class="flex justify-between mt-3">
                <div class="font-semibold">Payments:</div>
                <div></div>
            </div>
            <div class="flex justify-between">
                <span>Service Charge:</span>
                <span>₱{{ serviceCharge.toFixed(2) }}</span>
            </div>
            <div class="flex justify-between">
                <span>Other Charges:</span>
                <span>₱0.00</span>
            </div>
        </div>

        <div class="flex justify-between gap-2 mt-4">
            <button
                class="flex-1 bg-(--button-green) text-white py-2 rounded-lg font-semibold hover:bg-[#7ca460]"
                @click="$emit('void-order')"
            >
                Void
            </button>
            <button
                class="flex-1 bg-(--button-green) text-white py-2 rounded-lg font-semibold hover:bg-[#7ca460]"
            >
                Send Order Slip
            </button>
            <button
                class="flex-1 bg-(--button-green) text-white py-2 rounded-lg font-semibold hover:bg-[#7ca460]"
                @click="$emit('proceed')"
            >
                Print Bill
            </button>
        </div>
    </section>

    <PaymentModal
        v-if="showPaymentModal"
        :grandTotal="payableAmount"
        @close="showPaymentModal = false"
        @payment-confirmed="$emit('payment-confirmed', $event)"
    />

    <BillOut
        v-if="showBillOut"
        :orderItems="orderItems"
        :paidAmount="paidAmount"
        :changeAmount="changeAmount"
        @close="showBillOut = false"
        @confirm-payment="$emit('confirm')"
    />

</template>

<script setup lang="ts">
import { ref } from 'vue'
import BillOut from '@/components/BillOut.vue'
import PaymentModal from '@/components/PaymentModal.vue'

const props = defineProps({
    orderItems: {
        type: Array,
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
const paidAmount = ref(0)
const changeAmount = ref(0)

defineEmits<{
    (e: 'update-item-qty', item: any, newQty: number): void
    (e: 'remove-item', index: number): void
    (e: 'void-order'): void
    (e: 'proceed'): void
    (e: 'payment-confirmed', data: { paid: number, change: number }): void
    (e: 'confirm'): void
}>()
</script>