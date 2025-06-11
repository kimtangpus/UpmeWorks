<template>
    <section class="flex flex-col h-full bg-[#F8FAF8]">
        <!-- search bar header -->
        <div class="flex justify-between border-b border-gray-200 items-center p-4 flex-shrink-0 bg-white">
            <div class="relative w-1/2">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input :value="searchQuery"
                    @input="$emit('update:searchQuery', ($event.target as HTMLInputElement).value)" type="text"
                    placeholder="Search Menus"
                    class="p-2 pl-10 border border-[#CDCDCD] rounded-xl w-full shadow-sm focus:outline-none text-[#A3A3A3] bg-[#FBFBFB]" />
            </div>
        </div>

        <!-- Product cards container with dynamic scrolling -->
        <div class="flex-1 overflow-y-auto p-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                <ProductCard v-for="product in allProducts" :key="product.id" :product="product"
                    @add-to-order="$emit('add-to-order', product)" />
            </div>
        </div>

        <div v-if="(allProducts?.length ?? 0) === 0" class="text-center text-gray-500 p-4 flex-shrink-0">
            No menus available in this category.
        </div>
    </section>
</template>

<script setup lang="ts">
import ProductCard from './ProductCard.vue'

interface Product {
    id: number
    name: string
    price: number
    // Add other product properties as needed
}

const props = defineProps<{
    allProducts: Product[]
    searchQuery: string
}>()

defineEmits<{
    (e: 'update:searchQuery', value: string): void
    (e: 'add-to-order', product: Product): void
}>()
</script>