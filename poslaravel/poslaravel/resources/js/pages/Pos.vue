

<template>
  <div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-56 bg-white border-r flex flex-col justify-between">
      <div>
        <div class="p-4">
          <img src="/logo.png" alt="Logo" class="h-10 mb-4" />
        </div>
        <nav class="space-y-2 text-black">
          <SidebarButton icon="👤" label="Customers" />
          <SidebarButton icon="🧾" label="Orders" />
          <SidebarButton icon="💳" label="Cashier" />
          <SidebarButton icon="📊" label="Reports" />
        </nav>
      </div>
      <div class="space-y-2 p-4 text-black">
        <SidebarButton icon="⚙️" label="Settings" />
        <SidebarButton icon="↩️" label="Logout" />
      </div>
    </aside>

    <!-- Main Area -->
    <main class="flex-1 flex">
      <!-- Products Section -->
      <section class="w-2/3 p-4 overflow-y-auto text-black">
        <h2 class="font-semibold text-lg mb-2 text-black">Categories</h2>
        <div class="flex flex-wrap gap-2 mb-4">
          <CategoryButton v-for="category in categories" :key="category" :label="category" />
        </div>
        <input type="text-black" placeholder="Search Products..." class="mb-4 p-2 border rounded w-full" />

        <div class="grid grid-cols-5 gap-4">
          <ProductCard v-for="product in products" :key="product.id" :product="product" />
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

        <div class="text-5xl text-green-600 font-bold text-center mb-2">0.00</div>

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
          <button class="flex-1 bg-orange-500 hover:bg-orange-600 text-white p-3 rounded-lg text-lg font-semibold">⏸ Hold Order</button>
          <button class="flex-1 bg-green-600 hover:bg-green-700 text-white p-3 rounded-lg text-lg font-semibold">✅ Checkout</button>
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

const categories = ['BREAKFAST', 'BEVERAGES', 'PASTA', 'SUSHI', 'SIDE DISH', 'RICE BOWL', 'MEALS', 'APPETIZERS']
const products = [
  { id: 1, name: 'EXTREME HOG FINISHER', price: 1700, image: '/sample-product.png' },
  { id: 2, name: 'FIESTA HOG GROWER', price: 1700, image: '/sample-product.png' },
  { id: 3, name: 'FIESTA HOG GROWER', price: 1700, image: '/sample-product.png' },
  { id: 4, name: 'FIESTA HOG GROWER', price: 1700, image: '/sample-product.png' },
  { id: 5, name: 'FIESTA HOG GROWER', price: 1700, image: '/sample-product.png' },

  // Add more products
]

const currentDate = new Date().toLocaleDateString()
const currentTime = new Date().toLocaleTimeString()
</script>

<style scoped>
/* Add any custom styling if needed */
</style>
