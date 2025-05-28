<template>
  <button class="w-full text-left px-4 py-2 hover:bg-gray-200 flex items-center gap-2">
   <span>{{ icon }}</span>
    <span>{{ label }}</span>
  </button>
</template>

<script setup>
defineProps(['label'])
</script>
