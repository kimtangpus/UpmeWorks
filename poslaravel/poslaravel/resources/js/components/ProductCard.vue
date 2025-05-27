<template>
  <div class="p-2 border rounded hover:shadow cursor-pointer text-center">
    <img :src="product.image" alt="" class="h-20 mx-auto mb-2 object-contain" />
    <div class="text-sm font-semibold">{{ product.name }}</div>
    <div class="text-sm text-gray-500">₱ {{ product.price.toFixed(2) }}</div>
  </div>
</template>

<script setup>
defineProps(['product'])
</script>
