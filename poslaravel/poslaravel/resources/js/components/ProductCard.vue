<template>
  <div
    class="bg-white border rounded-2xl shadow-md hover:shadow-lg transition p-4 flex flex-col justify-between items-center text-center"
  >
    <div class="w-full h-32 bg-gray-100 rounded-xl mb-3 flex items-center justify-center overflow-hidden">
      <img
        v-if="product.menu_image"
        :src="`/${product.menu_image}`"
        alt="Product Image"
        class="object-cover w-full h-full"
      />
      <span v-else class="text-gray-400 text-sm">Image</span>
    </div>

    <h3
      class="font-semibold text-base truncate w-full text-green-700"
      :title="product.name"
    >
      {{ product.name }}
    </h3>

    <p class="text-[#87b46f] font-semibold text-lg mt-1">
      ₱{{ Number(product.price).toFixed(2) }}
    </p>

    <button
      @click="$emit('add-to-order', product)"
      class="mt-4 bg-green-600 hover:bg-green-700 text-white w-full py-2 rounded-lg text-sm font-semibold"
      type="button"
    >
      Add
    </button>
  </div>
</template>

<script setup>
const props = defineProps({
  product: {
    type: Object,
    required: true
  }
})
</script>
