<template>
    <div :class="[
        'rounded-xl shadow p-4 flex flex-col items-center justify-center space-y-4 aspect-square text-(--upme-dark-green) hover:bg-[#F0F0F0] cursor-pointer',
        statusClasses
    ]">
        <div class="text-2xl font-bold">
            Table {{ tableNumber }}
        </div>

        <i class="fas fa-utensils text-5xl"></i>

        <div class="font-medium text-lg">
            ₱{{ billAmount.toFixed(2) }}
        </div>
    </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'

const props = defineProps < {
    tableNumber: number
    billAmount: number
    status: string // 'occupied', 'free', 'billPrinted'
} > ()

const statusClasses = computed(() => {
    switch (props.status) {
        case 'occupied':
            return 'bg-gray-200'
        case 'free':
            return 'bg-white' 
        case 'billPrinted':
            return 'bg-(--upme-light-green)'
        default:
            return 'bg-white text-(--upme-dark-green)'
    }
})
</script>
  
