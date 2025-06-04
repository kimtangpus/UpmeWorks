<template>
    <section class="w-2/3 p-4 bg-[#F8FAF8] rounded-2xl shadow flex flex-col">
        <!-- search bar header -->
        <div class="flex justify-between items-center mb-4">  
            <div class="relative w-1/2">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input
                    :value="searchQuery"
                    @input="$emit('update:searchQuery', ($event.target as HTMLInputElement).value)"
                    type="text"
                    placeholder="Search Menus"
                    class="p-2 pl-10 border border-[#d0e0cd] rounded-xl w-full shadow-sm focus:outline-none text-[#2e3c2f]"
                />
            </div>
        </div>

        <div class="grid grid-cols-5 gap-4 bg-(--whote)">
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