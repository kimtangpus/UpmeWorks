<template>
  <div class="flex flex-col min-h-screen bg-[#f2f7f1]">
    
    <div class="flex flex-1 pb-20"> 
      <aside class="w-60 bg-[#FFFFFF] border-r flex flex-col text-[#2e3c2f]">
        <div class="p-4">
          <img src="/servelogo.png" alt="Logo" class="h-20 mx-auto mb-4" />
          
          <div class="h-150 overflow-y-auto">
          <div class="space-y-2">
            <CategoryButton
              v-for="category in categories"
              :key="category.id"
              :label="category.name"
              @click="selectedCategoryId = category.id"
              :class="[
                'w-full text-left px-4 py-2 rounded-lg font-semibold',
                selectedCategoryId === category.id ? 'bg-[#c9e4b3]' : 'hover:bg-[#dcedc8]'
              ]"
            />
            
          </div>
          </div>
        </div>
      </aside>

      <main class="flex-1 flex gap-4 p-4">
        <section class="w-2/3 p-4 bg-white rounded-2xl shadow flex flex-col">
          <div class="flex justify-between items-center mb-4">
            <h2 class="font-semibold text-xl text-[#2e3c2f]">Menus</h2>
            <input
              v-model="searchQuery"
              type="text"
              placeholder="Search Menus"
              class="p-2 border border-[#d0e0cd] rounded-xl w-1/3 shadow-sm focus:outline-none text-[#2e3c2f]"
            />
          </div>

          <div class="grid grid-cols-5 gap-4 ">
            <ProductCard
              v-for="product in allProducts"
              :key="product.id"
              :product="product"
              @add-to-order="addToOrder"
            />
          </div>

          <div v-if="allProducts.length === 0" class="text-center text-gray-500 mt-4">
            No menus available in this category.
          </div>
        </section>

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
                      @click="item.quantity > 1 && updateItemQty(item, item.quantity - 1)"
                      class="w-6 h-6 flex items-center justify-center bg-gray-200 hover:bg-gray-300 "
                    >−</button>
                    <span class="w-6 text-center">{{ item.quantity }}</span>
                    <button
                      @click="updateItemQty(item, item.quantity + 1)"
                      class="w-6 h-6 flex items-center justify-center bg-gray-200 hover:bg-gray-300 "
                    >+</button>
                  </div>
                  <button @click="removeItem(idx)" class=" text-xs hover:underline">🗑️</button>
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
              class="flex-1 bg-[--button-green] text-white py-2 rounded-lg font-semibold hover:bg-[#7ca460]"
              @click="voidOrder"
            >
              Void
            </button>
            <button
              class="flex-1 bg-[#87b46f] text-white py-2 rounded-lg font-semibold hover:bg-[#7ca460]"
            >
              Send Order Slip
            </button>
            <button
              class="flex-1 bg-[#87b46f] text-white py-2 rounded-lg font-semibold hover:bg-[#7ca460]"
              @click="handleProceed"
            >
              Print Bill
            </button>
          </div>
        </section>

        <PaymentModal
          v-if="showPaymentModal"
          :grandTotal="payableAmount"
          @close="showPaymentModal = false"
          @payment-confirmed="handlePaymentConfirmed"
        />

        <BillOut
          v-if="showBillOut"
          :orderItems="orderItems"
          :paidAmount="paidAmount"
          :changeAmount="changeAmount"
          @close="showBillOut = false"
          @confirm-payment="handleConfirm"
        />
      </main>
    </div>

    <div class="flex-none">
      <nav class="bg-white shadow-md border-t border-grey-200 fixed bottom-[32px] left-0 w-full z-40 flex justify-center space-x-8 text-(--dark-green) p-4">
        <BottomMenuButton icon="fas fa-circle-play" label="Start Day" />
        <BottomMenuButton icon="fas fa-stop" label="End Day" />
        <BottomMenuButton icon="fas fa-file-invoice-dollar" label="Show Orders" />
        <BottomMenuButton icon="fas fa-percent" label="Apply Discount" />
        <BottomMenuButton icon="fas fa-cash-register" label="Bill Out" />
        <BottomMenuButton icon="fas fa-arrow-down-up-across-line" label="Transfer Table" />
        <BottomMenuButton icon="fas fa-file-invoice-dollar" label="Refunds" />
        <BottomMenuButton icon="fas fa-divide" label="Split Bill" />
        <BottomMenuButton icon="fas fa-print" label="Print X-Report" />
        <BottomMenuButton icon="fas fa-print" label="Print Z-Report" />
        <BottomMenuButton icon="fas fa-file" label="Reports" />
        <BottomMenuButton icon="fas fa-clipboard" label="Back Office" />
      </nav>

      <div class="bg-(--light-green) text-(--dark-green) text-xs py-2 px-4 fixed bottom-0 left-0 w-full z-50 flex justify-between items-center">
        <div class="font-bold">
          © 2025 UPme Works. All rights reserved.
        </div>
        <div class="font-bold">
          Wed Apr 23  4:41 PM (hardcoded pa to)
        </div>
      </div>
    </div>

  </div>
</template>


<script setup>
import { ref, onMounted, computed, onBeforeUnmount } from 'vue'
import CategoryButton from '@/components/CategoryButton.vue'
import ProductCard from '@/components/ProductCard.vue'
import BillOut from '@/components/BillOut.vue'
import PaymentModal from '@/components/PaymentModal.vue'
import BottomMenuButton from '@/components/BottomMenuButton.vue'


const props = defineProps({
  categories: Array
})

const selectedCategoryId = ref(null)
const searchQuery = ref('')
const currentDate = ref('')
const currentTime = ref('')
const categoryContainer = ref(null)
const showPaymentModal = ref(false)
const showBillOut = ref(false)
const orderItems = ref([])
const paidAmount = ref(0)
const changeAmount = ref(0)

onMounted(() => {
  updateDateTime()
  const interval = setInterval(updateDateTime, 1000)
  onBeforeUnmount(() => clearInterval(interval))
})

function updateDateTime() {
  const now = new Date()
  currentDate.value = now.toLocaleDateString('en-US', {
    weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
  })
  currentTime.value = now.toLocaleTimeString('en-US', {
    hour: 'numeric', minute: '2-digit'
  })
}

function scrollCategories(direction) {
  if (!categoryContainer.value) return
  const scrollAmount = 150
  categoryContainer.value.scrollBy({
    left: direction === 'left' ? -scrollAmount : scrollAmount,
    behavior: 'smooth'
  })
}

function addToOrder(product) {
  const idx = orderItems.value.findIndex(item => item.id === product.id)
  if (idx !== -1) {
    const existing = orderItems.value[idx]
    existing.quantity += 1
    updateItemTotal(existing)
  } else {
    orderItems.value.push({
      id: product.id,
      name: product.name,
      price: product.price,
      quantity: 1,
      discount: 0,
      total: product.price
    })
  }
}

function updateItemTotal(item) {
  item.quantity = Math.max(1, item.quantity)
  item.discount = Math.min(100, Math.max(0, item.discount))
  item.total = item.quantity * item.price * (1 - item.discount / 100)
}

function removeItem(index) {
  orderItems.value.splice(index, 1)
}

const subtotal = computed(() =>
  orderItems.value.reduce((sum, item) => sum + item.price * item.quantity, 0)
)

const discountTotal = computed(() =>
  orderItems.value.reduce((sum, item) =>
    sum + item.price * item.quantity * (item.discount / 100), 0)
)

const tax = computed(() =>
  (subtotal.value - discountTotal.value) * 0.12
)

const payableAmount = computed(() =>
  subtotal.value - discountTotal.value + tax.value
)

const allProducts = computed(() => {
  let products = []
  if (selectedCategoryId.value !== null) {
    const selected = props.categories.find(c => c.id === selectedCategoryId.value)
    products = selected?.menus ?? []
  } else {
    products = props.categories.flatMap(c => c.menus ?? [])
  }

  if (searchQuery.value.trim()) {
    const q = searchQuery.value.toLowerCase()
    products = products.filter(p => p.name.toLowerCase().includes(q))
  }

  return products
})

function handleProceed() {
  showPaymentModal.value = true
}

function handlePaymentConfirmed({ paid, change }) {
  paidAmount.value = paid
  changeAmount.value = change
  showPaymentModal.value = false
  showBillOut.value = true
}

function handleConfirm() {
  alert('Payment Confirmed!')
  showBillOut.value = false
  orderItems.value = []
}

function updateItemQty(item, newQty) {
  item.quantity = Math.max(1, newQty)
  updateItemTotal(item)
}

function voidOrder() {
  if (confirm("Are you sure you want to void this order?")) {
    orderItems.value = []
  }
}

const serviceCharge = computed(() =>
  (subtotal.value - discountTotal.value) * 0.1 
)

</script>


<style scoped>

</style>
