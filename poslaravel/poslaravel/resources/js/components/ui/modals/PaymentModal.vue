<template>
  <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-96 text-black">
      <div class="flex items-center justify-between p-4 border-b">
        <div>
          <div class="text-sm text-gray-500">Payable Amount</div>
          <div class="text-2xl font-bold text-green-600">₱{{ grandTotal.toFixed(2) }}</div>
        </div>
        <div class="flex items-center space-x-2">
          <img src="https://via.placeholder.com/40" class="w-10 h-10 rounded-full" />
          <div class="text-xs text-gray-600">
            Vincent Lobo<br />
            <span class="text-gray-400 text-[10px]">#5432845</span>
          </div>
        </div>
      </div>

      <div class="flex border-b text-sm">
        <button
          class="flex-1 py-2 text-center"
          :class="{ 'border-b-2 border-orange-500 font-semibold': activeTab === 'cash' }"
          @click="activeTab = 'cash'"
        >
          Cash
        </button>
        <button
          class="flex-1 py-2 text-center"
          :class="{ 'border-b-2 border-orange-500 font-semibold': activeTab === 'other' }"
          @click="activeTab = 'other'"
        >
          Other Modes
        </button>
      </div>

 
      <div v-if="activeTab === 'cash'" class="p-4">
        <input
          type="text"
          v-model="displayAmount"
          readonly
          class="w-full text-right text-2xl border-b border-gray-300 pb-2 mb-4 focus:outline-none"
        />
        <div class="grid grid-cols-3 gap-2">
          <button v-for="n in buttons" :key="n" @click="press(n)" class="p-4 bg-gray-100 rounded text-lg">
            {{ n }}
          </button>
          <button @click="clearAndCancel" class="p-4 bg-gray-200 rounded col-span-2">Cancel</button>
          <button @click="confirmPayment" class="p-4 bg-green-600 text-white rounded">✓</button>
        </div>
      </div>

      
      <div v-else class="p-4 text-center text-gray-500">
        Other payment modes coming soon...
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
  grandTotal: Number
})
const emit = defineEmits(['close', 'payment-confirmed'])

const cashAmount = ref(0)
const displayAmount = ref('₱0.00')
const activeTab = ref('cash')

const buttons = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '00', '0', '←']

function press(val) {
  if (val === '←') {
    displayAmount.value = displayAmount.value.slice(0, -1)
  } else {
    displayAmount.value = displayAmount.value.replace(/[₱,]/g, '') + val
  }

  const raw = displayAmount.value.replace(/[^\d]/g, '')
  cashAmount.value = parseFloat(raw) || 0
  displayAmount.value = `₱${(cashAmount.value / 100).toFixed(2)}`
}

function clearAndCancel() {
  displayAmount.value = '₱0.00'
  cashAmount.value = 0
  emit('close') 
}

function confirmPayment() {
  const paid = cashAmount.value / 100
  if (paid >= props.grandTotal) {
    emit('payment-confirmed', {
      paid,
      change: paid - props.grandTotal
    })
  }
}
</script>
