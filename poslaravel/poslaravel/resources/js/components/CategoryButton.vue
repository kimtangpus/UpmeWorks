<template>
  <button
    class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300"
    @click="$emit('click')"
  >
    {{ label }}
  </button>
</template>

<script setup>
defineProps(['label'])
defineEmits(['click'])
</script>
