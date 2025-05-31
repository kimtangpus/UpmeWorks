<script setup>
defineProps({ product: Object })
</script>

<template>
  <div class="border p-2 rounded shadow hover:bg-gray-100">
    <img :src="product.menu_image || '/default.png'" alt="" class="w-full h-24 object-cover mb-2">
    <h3 class="font-semibold text-sm">{{ product.name }}</h3>
    <p class="text-xs text-gray-600">₱{{ product.price }}</p>
  </div>
</template>
