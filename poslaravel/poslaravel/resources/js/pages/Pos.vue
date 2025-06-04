<template>
  <div class="flex flex-col h-screen bg-[#f2f7f1]">
    <div class="flex flex-1 pb-40"> <!-- Add padding-bottom to account for fixed bottom menu -->
      <!-- Sidebar -->
      <AppSidebar
        :categories="categories"
        v-model:selectedCategoryId="selectedCategoryId"
      />
      <div class="flex-1 flex flex-col">
        <!-- Header -->
        <AppHeader />
       
        <!-- Main Content -->
        <main class="flex-1 flex gap-4 p-4">
          <MenuListings
            :allProducts="allProducts"
            v-model:searchQuery="searchQuery"
            @add-to-order="addToOrder"
          />
          <TotalOrderCalc
            :orderItems="orderItems"
            :subtotal="subtotal"
            :discountTotal="discountTotal"
            :tax="tax"
            :serviceCharge="serviceCharge"
            :payableAmount="payableAmount"
            @update-item-qty="updateItemQty"
            @remove-item="removeItem"
            @void-order="voidOrder"
            @proceed="handleProceed"
            @payment-confirmed="handlePaymentConfirmed"
            @confirm="handleConfirm"
          />
        </main>
      </div>
    </div>
    <!-- Bottom Menu  -->
    <BottomMenu
      :orderItems="orderItems"
      :currentDate="currentDate"
      :currentTime="currentTime" 
    /> 
  </div>
</template>


<script setup>
import { ref, onMounted, computed, onBeforeUnmount } from 'vue'
import AppSidebar from '@/components/AppSidebar.vue'
import BottomMenu from '@/components/ui/BottomMenu.vue'
import MenuListings from '@/components/MenuListings.vue'
import TotalOrderCalc from '@/components/TotalOrderCalc.vue'
import AppHeader from '@/components/AppHeader.vue'


const props = defineProps({
  categories: Array
})

const searchQuery = ref('')
const selectedCategoryId = ref(null)
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

  // Format: Wed Apr 23
  const date = now.toLocaleDateString('en-US', {
    weekday: 'short',  // Wed
    month: 'short',    // Apr
    day: 'numeric'     // 23
  })

  const time = now.toLocaleTimeString('en-US', {
    hour: 'numeric',
    minute: '2-digit',
    hour12: true       // ensures AM/PM format
  })

  currentDate.value = date
  currentTime.value = time
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

function updateItemQty(item, newQty) {
  item.quantity = Math.max(1, newQty)
  updateItemTotal(item)
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

const serviceCharge = computed(() =>
  (subtotal.value - discountTotal.value) * 0.1
)

const payableAmount = computed(() =>
  subtotal.value - discountTotal.value + tax.value + serviceCharge.value
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

function voidOrder() {
  if (confirm("Are you sure you want to void this order?")) {
    orderItems.value = []
  }
}

</script>


<style scoped>

</style>
