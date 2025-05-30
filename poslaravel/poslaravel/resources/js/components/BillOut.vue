<!-- resources/js/Pages/BillOut.vue -->
<template>
  <div class="flex h-full">
    <!-- LEFT SIDE: Order Summary -->
    <section class="w-1/2 p-6 bg-white shadow-lg rounded overflow-y-auto">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Order ID #{{ order.id }}</h2>
        <p class="text-sm text-gray-500">Dine-In • {{ order.table }}</p>
      </div>

      <ul class="divide-y">
        <li v-for="(item, index) in order.items" :key="index" class="py-3 flex justify-between">
          <div>
            <p class="font-medium">{{ index + 1 }}. {{ item.name }}</p>
            <p v-if="item.variant" class="text-xs text-gray-500">{{ item.variant }}</p>
          </div>
          <p>${{ item.price.toFixed(2) }}</p>
        </li>
      </ul>

      <div class="mt-6 space-y-1 text-sm">
        <div class="flex justify-between"><span>Subtotal</span><span>${{ order.subtotal.toFixed(2) }}</span></div>
        <div class="flex justify-between"><span>Tax</span><span>${{ order.tax.toFixed(2) }}</span></div>
        <div class="flex justify-between"><span>Discount</span><span>- ${{ order.discount.toFixed(2) }}</span></div>
        <div class="flex justify-between font-semibold text-lg"><span>Grand Total</span><span>${{ order.total.toFixed(2) }}</span></div>
      </div>

      <div class="mt-6 space-y-1 text-sm">
        <div class="flex justify-between"><span>Credit</span><span>${{ order.credit.toFixed(2) }}</span></div>
        <div class="flex justify-between"><span>Balance</span><span class="text-red-500">- ${{ (order.credit - order.total).toFixed(2) }}</span></div>
      </div>

      <button class="mt-6 w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold flex items-center justify-center gap-2">
        <i class="fas fa-check"></i>
        Confirm Payment
      </button>
    </section>

    <!-- RIGHT SIDE: Payment Pad -->
    <section class="w-1/2 p-6 bg-white shadow-lg rounded flex flex-col">
      <div>
        <p class="text-gray-500">Payable Amount</p>
        <p class="text-3xl font-bold text-green-600">${{ order.total.toFixed(2) }}</p>
      </div>

      <div class="mt-6">
        <ul class="flex border-b">
          <li :class="activeTab === 'cash' ? 'border-b-2 border-orange-500 text-orange-500' : 'text-gray-500'"
              class="px-4 py-2 cursor-pointer" @click="activeTab = 'cash'">Cash</li>
          <li :class="activeTab === 'other' ? 'border-b-2 border-orange-500 text-orange-500' : 'text-gray-500'"
              class="px-4 py-2 cursor-pointer" @click="activeTab = 'other'">Other Modes</li>
        </ul>

        <div v-if="activeTab === 'cash'" class="mt-4 flex-1 flex flex-col">
          <div class="text-right text-4xl font-semibold">${{ cashInput || '0.00' }}</div>
          <div class="grid grid-cols-3 gap-2 mt-4">
            <button v-for="key in keypad" :key="key" class="py-4 rounded-lg border hover:bg-gray-100" @click="press(key)">
              {{ key }}
            </button>
            <button class="py-4 rounded-lg border col-span-2 text-lg" @click="press('00')">00</button>
            <button class="py-4 rounded-lg border text-lg" @click="back()">⌫</button>
          </div>
        </div>

        <div v-else class="mt-4 text-center text-gray-400">
          Other payment modes coming soon…
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const order = ref({
  id: '0542145',
  table: 'T-34',
  items: [
    { name: 'Schezwan Egg Noodles', variant: '', price: 25 },
    { name: 'Spicy Shrimp Soup', variant: 'Medium • Half Grilled', price: 40 },
    { name: 'Fried Basil', variant: '', price: 25 }
  ],
  subtotal: 90,
  tax: 20,
  discount: 0,
  total: 110,
  credit: 120
})

const activeTab = ref('cash')
const cashInput = ref('')
const keypad = ['1','2','3','4','5','6','7','8','9','.','0']

function press(key) {
  if (key === '.' && cashInput.value.includes('.')) return
  cashInput.value = (cashInput.value + key).replace(/^0+(?!\.)/, '')
}

function back() {
  cashInput.value = cashInput.value.slice(0, -1)
}
</script>

<style scoped>
button {
  transition: all 0.2s;
}
</style>
