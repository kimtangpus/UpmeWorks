<template>
  <button class="px-3 py-1 my-3 border rounded-full bg-white hover:bg-gray-100 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-150 ease-in-out ">
    {{ label }}
  </button>
</template>

<script setup>
defineProps(['label'])
</script>
