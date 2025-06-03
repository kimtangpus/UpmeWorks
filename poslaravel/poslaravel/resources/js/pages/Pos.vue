<template>
  <div class="flex h-screen bg-gray-100">
    <aside class="w-56 bg-white border-r flex flex-col justify-between">
      <div>
        <div class="p-4">
          <img src="/servelogo.png" alt="Logo" class="h-12 mx-auto mb-2" style="width: 150px;" />
          <nav class="space-y-2 text-black">
            <SidebarButton icon="fas fa-user" label="Customers" />
            <SidebarButton icon="fas fa-receipt" label="Orders" />
            <SidebarButton icon="fas fa-cash-register" label="Cashier" />
            <SidebarButton icon="fas fa-chart-bar" label="Reports" />
          </nav>
        </div>
      </div>
      <div class="space-y-2 p-4 text-black">
        <SidebarButton icon="fas fa-cog" label="Settings" />
        <SidebarButton icon="fas fa-sign-out-alt" label="Logout" />
      </div>
    </aside>

    <main class="flex-1 flex">

      <section class="w-2/3 p-4 overflow-y-auto text-black border border-black rounded shadow bg-white">

        <div class="flex justify-between items-center mb-2">
          <h2 class="font-semibold text-xl">Categories</h2>
          <input
            v-model="searchQuery"
            type="text"
            placeholder="Search Menus"
            class="p-2 pl-3 border rounded w-1/3 focus:outline-none"
          />
        </div>

        <div class="flex items-center gap-2 mb-4">
          <button @click="scrollCategories('left')" class="text-2xl px-2 border-2 rounded hover:bg-gray-200 shadow h-14">
            &larr;
          </button>
          <div
            ref="categoryContainer"
            class="flex gap-2 overflow-x-auto scrollbar whitespace-nowrap flex-1 px-2"
          >
            <CategoryButton
              v-for="category in categories"
              :key="category.id"
              :label="category.name"
              @click="selectedCategoryId = category.id"
              :class="{ 'bg-gray-300': selectedCategoryId === category.id }"
            />
          </div>
          <button @click="scrollCategories('right')" class="text-2xl px-2 border-2 rounded hover:bg-gray-200 shadow h-14">
            &rarr;
          </button>
        </div>

        <div class="grid grid-cols-5 gap-4">
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


<section class="w-1/3 bg-white p-4 border-l flex flex-col text-black">

  <div class="flex justify-between items-center mb-4">
    <button class="bg-gray-200 px-4 py-2 rounded text-sm">+ Add Customer</button>
    <div class="flex gap-2">
      <button class="bg-gray-200 p-2 rounded">+</button>
      <button class="bg-gray-200 p-2 rounded">🔍</button>
    </div>
  </div>


  <div class="flex-grow space-y-3 overflow-y-auto pr-1">
    <div v-for="(item, idx) in orderItems" :key="item.id" class="border rounded-lg shadow p-3 bg-gray-50">
      <div class="flex justify-between items-center mb-2">
        <div class="font-semibold">{{ item.name }}</div>
        <div class="text-sm text-gray-600">₱{{ (item.price * item.quantity).toFixed(2) }}</div>
      </div>
      <div class="grid grid-cols-2 gap-2 text-xs">
        <div>
          Quantity
          <input
            type="number"
            v-model.number="item.quantity"
            min="1"
            class="w-full border rounded px-2 py-1 mt-1"
            @change="updateItemTotal(item)"
          />
        </div>
        <div>
          Discount(%)
          <input
            type="number"
            v-model.number="item.discount"
            min="0"
            max="100"
            class="w-full border rounded px-2 py-1 mt-1"
            @change="updateItemTotal(item)"
          />
        </div>
      </div>
      <div class="text-right text-sm mt-2 text-gray-600">
        <button @click="removeItem(idx)" class="text-red-500 hover:underline">Remove</button>
      </div>
    </div>
  </div>

  <div class="mt-4 flex justify-between text-sm">
    <button class="text-orange-500 font-semibold">Add</button>
    <button class="text-orange-500 font-semibold">Discount</button>
    <button class="text-orange-500 font-semibold">Coupon Code</button>
    <button class="text-orange-500 font-semibold">Note</button>
  </div>

 
  <div class="mt-4 border-t pt-4 text-sm">
    <div class="flex justify-between mb-2">
      <span>Subtotal</span>
      <span>₱{{ subtotal.toFixed(2) }}</span>
    </div>
    <div class="flex justify-between mb-2">
      <span>VAT</span>
      <span>₱{{ tax.toFixed(2) }}</span>
    </div>
    <div class="flex justify-between font-bold text-lg border-t pt-2">
      <span>Payable Amount</span>
      <span>₱{{ payableAmount.toFixed(2) }}</span>
    </div>
  </div>


  <div class="flex gap-4 mt-4">
    <button class="flex-1 bg-orange-500 hover:bg-orange-600 text-white p-3 rounded-lg text-lg font-semibold">
      Hold Order
    </button>
    <button
      class="bg-green-600 hover:bg-green-700 text-white p-3 rounded-lg text-lg font-semibold"
      @click="handleProceed"
    >
      Proceed
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
</template>
<script setup>
import { ref, onMounted, computed, onBeforeUnmount } from 'vue'
import SidebarButton from '@/components/SidebarButton.vue'
import CategoryButton from '@/components/CategoryButton.vue'
import ProductCard from '@/components/ProductCard.vue'
import BillOut from '@/components/BillOut.vue'
import PaymentModal from '@/components/PaymentModal.vue'


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


</script>


<style scoped>

</style>
