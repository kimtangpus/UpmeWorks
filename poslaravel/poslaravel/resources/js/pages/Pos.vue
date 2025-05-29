<template>
  <div class="flex h-screen bg-gray-100">
    <!-- sidebar -->
    <aside class="w-56 bg-white border-r flex flex-col justify-between">
      <div>
        <div class="p-4">
          <img src="/servelogo.png" alt="Logo" class="h-12 mx-auto mb-2" style="width: 150px; height: auto;" />
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

    <!-- main  -->
    <main class="flex-1 flex">
      <!-- categories -->
      <section class="w-2/3 p-4 overflow-y-auto text-black border border-black rounded shadow bg-white">
        
        <div class="flex justify-between items-center mb-2">
          <h2 class="font-semibold text-xl text-black">Categories</h2>
          <div class="relative w-1/3">
            <input
              type="text"
              placeholder="Search Products"
              class="p-2 pl-3 border rounded w-full focus:outline-none"
            />
            <svg
              class="w-5 h-5 absolute right-3 top-2.5 text-gray-500"
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

       
        <div class="flex items-center gap-2 mb-4">
          <button @click="scrollCategories('left')" class="text-2xl px-2 border-2 rounded hover:bg-gray-200 shadow" style="height:60px">&larr;</button>

          <div
            ref="categoryContainer"
            class="flex gap-2 overflow-x-auto scrollbar whitespace-nowrap flex-1 px-2"
          >
            <CategoryButton
              v-for="category in categories"
              :key="category.id"
              :label="category.name"
            />
          </div>

          <button @click="scrollCategories('right')" class="text-2xl px-2 border-2 rounded hover:bg-gray-200 shadow "style="height:60px">&rarr;</button>
        </div>

        <!-- products -->
        <div class="grid grid-cols-5 gap-4">
          <ProductCard
            v-for="product in products"
            :key="product.id"
            :product="product"
          />
        </div>
      </section>

      <!-- order -->
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

        <div class="text-6xl font-bold text-green-400 text-center bg-black border-4 border-gray-500 shadow-inner px-4 py-2 rounded-md tracking-widest">
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
          <!-- ordered items -->
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

const categories = ref([
  { id: 1, name: 'BREAKFAST' },
  { id: 2, name: 'BEVERAGES' },
  { id: 3, name: 'PASTA' },
  { id: 4, name: 'SUSHI' },
  { id: 5, name: 'SIDE DISH' },
  { id: 6, name: 'RICE BOWL' },
  { id: 7, name: 'MEALS' },
  { id: 8, name: 'APPETIZERS' },
  { id: 9, name: 'GROUP 9' },
  { id: 10, name: 'GROUP 10' },
  { id: 11, name: 'GROUP 11' },
  { id: 12, name: 'GROUP 12' }
])

const products = ref([
  { id: 1, name: 'EXTREME HOG FINISHER', price: 1700, image: '/sample-product.png' },
  { id: 2, name: 'FIESTA HOG GROWER', price: 1700, image: '/sample-product.png' },
  { id: 3, name: 'FIESTA HOG GROWER', price: 1700, image: '/sample-product.png' },
  { id: 4, name: 'FIESTA HOG GROWER', price: 1700, image: '/sample-product.png' },
  { id: 5, name: 'FIESTA HOG GROWER', price: 1700, image: '/sample-product.png' },
  { id: 6, name: 'FIESTA HOG GROWER', price: 1700, image: '/sample-product.png' }
])

const currentDate = ref('')
const currentTime = ref('')

const updateDateTime = () => {
  const now = new Date()

 
  currentDate.value = now.toLocaleDateString('en-US', {
    weekday: 'long',
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  })

 
  currentTime.value = now.toLocaleTimeString('en-US', {
    hour: 'numeric',
    minute: '2-digit'
  })
}

onMounted(() => {
  updateDateTime()
  setInterval(updateDateTime, 1000)
})

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

</style>
