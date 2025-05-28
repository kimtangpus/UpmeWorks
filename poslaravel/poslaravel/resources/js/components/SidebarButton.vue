<template>
  <button
    class="flex flex-col items-center gap-1 p-5 hover:bg-gray-100 w-full text-center border border-gray-200 text-gray-700 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 rounded-lg transition duration-150 ease-in-out"
  >
    <i v-if="icon" :class="icon" class="text-xl"></i>
    <span class="text-sm">{{ label }}</span>
  </button>
</template>

<script setup>
defineProps({
  label: String,
  icon: String
})
</script>
