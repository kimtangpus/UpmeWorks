

<template>
  <div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-56 bg-white border-r flex flex-col justify-between">
      <div>
        <div class="p-4">
          <img src="/logo.png" alt="Logo" class="h-10 mb-4" />
        </div>
        <nav class="space-y-2 text-black">
          <SidebarButton  label="Customers" />
          <SidebarButton  label="Orders" />
          <SidebarButton  label="Cashier" />
          <SidebarButton  label="Reports" />
        </nav>
      </div>
      <div class="space-y-2 p-4 text-black">
        <SidebarButton  label="Settings" />
        <SidebarButton  label="Logout" />
      </div>
    </aside>

    <!-- Main Area -->
    <main class="flex-1 flex">
      <!-- Products Section -->


<section class="w-2/3 p-4 overflow-y-auto text-black border border-black rounded shadow bg-white">
  <!-- Header: Categories & Search -->
  <div class="flex justify-between items-center mb-2">
    <h2 class="font-semibold text-lg text-black">Categories</h2>
    <div class="relative w-1/3">
      <input
        type="text"
        placeholder="Search Products..."
        class="p-2 pl-10 border rounded w-full focus:outline-none"
      />
      <svg
        class="w-5 h-5 absolute left-3 top-2.5 text-gray-500"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
      </svg>
    </div>
  </div>

  <!-- Scrollable Categories with Arrows -->
  <div class="flex items-center gap-2 mb-4">
    <button @click="scrollCategories('left')" class="text-2xl px-2 border-2 rounded shadow">&larr;</button>

    <div
      ref="categoryContainer"
      class="flex gap-2 overflow-x-auto no-scrollbar whitespace-nowrap flex-1 px-2"
    >
      <CategoryButton
        v-for="category in categories"
        :key="category"
        :label="category"
      />
    </div>

    <button @click="scrollCategories('right')" class="text-2xl px-2 border-2 rounded shadow">&rarr;</button>
  </div>

  <!-- Product Grid -->
  <div class="grid grid-cols-5 gap-4">
    <ProductCard
      v-for="product in products"
      :key="product.id"
      :product="product"
    />
  </div>
</section>

      <!-- Order Section -->
      <section class="w-1/3 border-l p-4 bg-white flex flex-col text-black">
        <div class="flex justify-between mb-2 text-sm">
          <div>
            <p>Order No: 001</p>
            <p>Customer: Guest</p>
          </div>
          <div class="text-right">
            <p>{{ currentDate }}</p>
            <p>{{ currentTime }}</p>
          </div>
        </div>

        <div class="text-6xl font-bold text-white text-center bg-black border-4 border-gray-500 shadow-inner px-4 py-2 rounded-md  tracking-widest">
  0.00
</div>

        <div class="grid grid-cols-5 text-sm border-b font-semibold py-2 text-black">
          <div>PARTICULAR</div>
          <div>PRICE</div>
          <div>QTY</div>
          <div>U/DISC</div>
          <div>AMOUNT</div>
        </div>

        <div class="flex-grow overflow-y-auto">
          <!-- Cart Items will go here -->
        </div>

        <div class="flex gap-4 mt-4">
          <button class="flex-1 bg-orange-500 hover:bg-orange-600 text-white p-3 rounded-lg text-lg font-semibold">Hold Order</button>
          <button class="flex-1 bg-green-600 hover:bg-green-700 text-white p-3 rounded-lg text-lg font-semibold">Checkout</button>
        </div>
      </section>
    </main>
  </div>
</template>

<script setup>
import SidebarButton from '@/Components/SidebarButton.vue'
import CategoryButton from '@/Components/CategoryButton.vue'
import ProductCard from '@/Components/ProductCard.vue'
import { ref, onMounted } from 'vue'

const categories = ['BREAKFAST', 'BEVERAGES', 'PASTA', 'SUSHI', 'SIDE DISH', 'RICE BOWL', 'MEALS', 'APPETIZERS', 'GROUP 9', 'GROUP 10', 'GROUP 11', 'GROUP 12']
const products = [
  { id: 1, name: 'EXTREME HOG FINISHER', price: 1700, image: '/sample-product.png' },
  { id: 2, name: 'FIESTA HOG GROWER', price: 1700, image: '/sample-product.png' },
  { id: 3, name: 'FIESTA HOG GROWER', price: 1700, image: '/sample-product.png' },
  { id: 4, name: 'FIESTA HOG GROWER', price: 1700, image: '/sample-product.png' },
  { id: 5, name: 'FIESTA HOG GROWER', price: 1700, image: '/sample-product.png' },

  
]

const currentDate = new Date().toLocaleDateString()
const currentTime = new Date().toLocaleTimeString()



const categoryContainer = ref(null)

function scrollCategories(direction) {
  const container = categoryContainer.value
  const scrollAmount = 150
  if (!container) return

  if (direction === 'left') {
    container.scrollBy({ left: -scrollAmount, behavior: 'smooth' })
  } else {
    container.scrollBy({ left: scrollAmount, behavior: 'smooth' })
  }
}

</script>

<style scoped>
/* Add any custom styling if needed */
</style>
