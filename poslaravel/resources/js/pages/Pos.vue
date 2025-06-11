<template>
  <div class="flex h-screen bg-[#f2f7f1] pb-[132px]">
    <!-- Sidebar -->
    <AppSidebar
      :categories="categories"
      v-model:selectedCategoryId="selectedCategoryId"
      class="pb-[132px]"
    />
    
    <!-- Main Content Area -->
    <!-- hard coded padding bottom since it's always overlapping, unsure if there's a better way -->
    <div class="flex-1 flex flex-col overflow-hidden">
      <!-- Header -->
      <AppHeader />
      
      <!-- Content Area -->
      <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Main Content -->
        <main class="flex-1 flex overflow-hidden">
          <ProductListings
            :allProducts="allProducts"
            v-model:searchQuery="searchQuery"
            @add-to-order="addToOrder"
            class="flex-1"
          />
          <TotalOrderCalc
            :orderItems="orderItems"
            :subtotal="subtotal"
            :discountTotal="discountTotal"
            :tax="tax"
            :serviceCharge="serviceCharge"
            :payableAmount="payableAmount"
            :showPaymentModal="showPaymentModal"
            :showBillOut="showBillOut"
            :paidAmount="paidAmount"
            :changeAmount="changeAmount"
            @update-item-qty="updateItemQty"
            @remove-item="removeItem"
            @void-order="voidOrder"
            @confirm="handleConfirm"
          />
        </main>        
      </div>
    </div>
    <div class="flex flex-col gap- 4">
      <BottomMenu
        :orderItems="orderItems"
        class="fixed bottom-0 left-0 w-full z-50"
      />

      <CopyrightFooter />
    </div>    
  </div>

</template>


<script setup lang="ts">
import { ref, computed } from 'vue'
import AppSidebar from '@/components/AppSidebar.vue'
import BottomMenu from '@/components/BottomMenu.vue'
import ProductListings from '@/components/ProductListings.vue'
import TotalOrderCalc from '@/components/TotalOrderCalc.vue'
import AppHeader from '@/components/AppHeader.vue'
import CopyrightFooter from '@/components/ui/footer/CopyrightFooter.vue'

const props = defineProps({
  categories: Array
})

const searchQuery = ref('')
const selectedCategoryId = ref(null)
const showPaymentModal = ref(false)
const showBillOut = ref(false)
const orderItems = ref([])
const paidAmount = ref(0)
const changeAmount = ref(0)


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
