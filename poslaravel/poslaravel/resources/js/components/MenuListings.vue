<template>
    <section class="w-2/3 p-4 bg-white rounded-2xl shadow flex flex-col">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-semibold text-xl text-[#2e3c2f]">Menus</h2>
            
            <input
                :value="searchQuery"
                @input="$emit('update:searchQuery', ($event.target as HTMLInputElement).value)"
                type="text"
                placeholder="Search Menus"
                class="p-2 border border-[#d0e0cd] rounded-xl w-1/3 shadow-sm focus:outline-none text-[#2e3c2f]"
            />
        </div>

        <div class="grid grid-cols-5 gap-4">
            <ProductCard
                v-for="product in allProducts"
                :key="product.id"
                :product="product"
                @add-to-order="$emit('add-to-order', product)"
            />
        </div>

        <div v-if="(allProducts?.length ?? 0) === 0" class="text-center text-gray-500 mt-4">
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