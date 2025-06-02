<template>
  <div class="fixed inset-0 z-50 bg-black bg-opacity-30 flex items-center justify-center">
    <div class="bg-white text-black rounded-xl shadow-xl w-[400px] max-h-[90vh] overflow-y-auto border-2 border-purple-300 relative p-4">

      <button class="absolute top-2 right-2 text-black hover:text-black text-xl" @click="$emit('close')">×</button>


      <h2 class="text-lg font-bold mb-1">Order ID #0542145</h2>
      <p class="text-sm mb-4">Vincent Lobo</p>


      <div class="divide-y text-sm">
        <div v-for="item in orderItems" :key="item.id" class="py-2">
          <div class="flex justify-between">
            <span>{{ item.name }}</span>
            <span>₱{{ (item.price * item.quantity).toFixed(2) }}</span>
          </div>
          <div class="text-xs pl-2">
            Qty: {{ item.quantity }} 
            <span v-if="item.discount"> | Disc: {{ item.discount }}%</span>
          </div>
        </div>
      </div>

      <div class="border-t mt-4 pt-2 text-sm">
        <div class="flex justify-between">
          <span>Subtotal</span>
          <span>₱{{ subtotal.toFixed(2) }}</span>
        </div>
        <div class="flex justify-between">
          <span>Tax</span>
          <span>₱{{ tax.toFixed(2) }}</span>
        </div>
        <div class="flex justify-between">
          <span>Discount</span>
          <span>-₱{{ discountTotal.toFixed(2) }}</span>
        </div>
        <div class="flex justify-between font-semibold text-lg mt-2">
          <span>Grand Total</span>
          <span>₱{{ grandTotal.toFixed(2) }}</span>
        </div>
      </div>

      <div class="mt-4 text-sm">
        <div class="flex justify-between">
          <span>Credit</span>
          <span>₱{{ paidAmount.toFixed(2) }}</span>
        </div>
        <div class="flex justify-between font-semibold">
          <span>Balance</span>
          <span :class="(paidAmount - grandTotal) < 0 ? 'text-red-600' : 'text-black'">
            ₱{{ (paidAmount - grandTotal).toFixed(2) }}
          </span>
        </div>
      </div>


      <button
        class="mt-6 bg-green-500 hover:bg-green-600 text-white w-full py-2 rounded font-semibold"
        @click="$emit('confirm-payment')"
      >
        Confirm Payment
      </button>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  orderItems: Array,
  paidAmount: Number
})

const subtotal = computed(() =>
  props.orderItems.reduce((sum, item) => sum + item.price * item.quantity, 0)
)

const discountTotal = computed(() =>
  props.orderItems.reduce((sum, item) => sum + item.price * item.quantity * (item.discount / 100), 0)
)

const tax = computed(() => subtotal.value * 0.225)

const grandTotal = computed(() =>
  subtotal.value + tax.value - discountTotal.value
)
</script>
