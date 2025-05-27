<template>
  <button class="px-3 py-1 border rounded-full bg-white hover:bg-gray-100 text-sm font-medium">
    {{ label }}
  </button>
</template>

<script setup>
defineProps(['label'])
</script>
