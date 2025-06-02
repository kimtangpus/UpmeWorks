<template>
  <div class="fixed inset-0 z-50 bg-black bg-opacity-30 flex items-center justify-center print:bg-transparent print:relative print:inset-0">
    <div
      id="billout-content"
      class="bg-white text-black rounded-xl shadow-xl w-[400px] max-h-[90vh] overflow-y-auto border-2 border-purple-300 relative p-4 print:shadow-none print:border-none print:max-h-full"
    >

      <button
        class="absolute top-2 right-2 text-black hover:text-black text-xl print:hidden"
        @click="$emit('close')"
      >
        ×
      </button>


      <h2 class="text-lg font-bold mb-1">Order ID #0542145</h2>
      <p class="text-sm mb-4">Vincent Lobo</p>


      <div class="divide-y text-sm">
        <div v-for="item in orderItems" :key="item.id" class="py-2">
          <div class="flex justify-between">
            <span>{{ item.name }}</span>
            <span>₱{{ item.total.toFixed(2) }}</span>
          </div>
          <div class="text-xs pl-2">
            Quantity: {{ item.quantity }}
            <span v-if="item.discount"> | Discount: {{ item.discount }}%</span>
          </div>
        </div>
      </div>


      <div class="border-t mt-4 pt-2 text-sm">
        <div class="flex justify-between">
          <span>Subtotal</span>
          <span>₱{{ subtotal.toFixed(2) }}</span>
        </div>
        <div class="flex justify-between">
          <span>VAT</span>
          <span>₱{{ tax.toFixed(2) }}</span>
        </div>
        <div class="flex justify-between font-semibold text-lg mt-2">
          <span>Grand Total</span>
          <span>₱{{ grandTotal.toFixed(2) }}</span>
        </div>
      </div>


      <div class="mt-4 text-sm">
        <div class="flex justify-between">
          <span>Cash Paid</span>
          <span>₱{{ paidAmount.toFixed(2) }}</span>
        </div>
        <div class="flex justify-between font-semibold">
          <span>Change</span>
          <span class="text-black">₱{{ changeAmount.toFixed(2) }}</span>
        </div>
      </div>


      <div class="mt-6 space-y-2 print:hidden">
        <button
          class="bg-green-500 hover:bg-green-600 text-white w-full py-2 rounded font-semibold"
          @click="confirmAndPrint"
        >
          Confirm & Print
        </button>
        <button
          class="bg-gray-300 hover:bg-gray-400 text-black w-full py-2 rounded font-semibold"
          @click="$emit('close')"
        >
          Cancel
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  orderItems: Array,
  paidAmount: Number,
  changeAmount: Number
})

const emit = defineEmits(['confirm-payment', 'close'])

const subtotal = computed(() =>
  props.orderItems.reduce((sum, item) => sum + item.price * item.quantity, 0)
)

const discountTotal = computed(() =>
  props.orderItems.reduce((sum, item) => sum + (item.price * item.quantity * (item.discount / 100)), 0)
)

const tax = computed(() =>
  (subtotal.value - discountTotal.value) * 0.12
)

const grandTotal = computed(() =>
  subtotal.value - discountTotal.value + tax.value
)

function confirmAndPrint() {
  const printContents = document.getElementById('billout-content').innerHTML
  const originalContents = document.body.innerHTML

  document.body.innerHTML = printContents
  window.print()
  document.body.innerHTML = originalContents
  location.reload()
  emit('confirm-payment')
}
</script>

<style scoped>
@media print {
  body * {
    visibility: hidden;
  }

  #billout-content,
  #billout-content * {
    visibility: visible;
  }

  #billout-content {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
  }
}
</style>
