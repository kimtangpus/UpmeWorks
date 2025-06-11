<template>
  <div
    @click="$emit('add-to-order', product)"
    class="bg-white rounded-2xl shadow-md border border-transparent 
           hover:bg-gray-300 active:border-[var(--upme-dark-green)] transition flex flex-col justify-between cursor-pointer"
  >
    <div class="w-full h-32 bg-gray-100 rounded-t-xl mb-3 flex items-center justify-center overflow-hidden">
      <img
        v-if="product.menu_image"
        :src="`/${product.menu_image}`"
        alt="Product Image"
        class="object-cover w-full h-full"
      />
      <span v-else class="text-gray-400 text-sm">Image</span>
    </div>

    <div class="mx-4 mb-4">
      <div class="flex justify-between items-center w-full">
        <h3
          class="font-semibold text-base truncate text-(--upme-dark-green)"
          :title="product.name"
          >
          {{ product.name }}
        </h3>
      </div> 
    
      <div class="flex justify-end mt-2">
        <p class="text-(--button-green) font-semibold text-md ml-4 whitespace-nowrap">    
          ₱{{ Number(product.price).toFixed(2) }}
        </p>
      </div>
    </div>

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
