<template>
  <router-link
    v-if="to"
    :to="to"
    class="flex flex-col items-center gap-1 p-3 rounded hover:bg-gray-100 cursor-pointer text-center"
  >
    <i :class="icon" class="text-xl"></i>
    <span class="text-sm">{{ label }}</span>
  </router-link>

  <button
    v-else
    @click="$emit('click')"
    class="flex flex-col items-center gap-1 p-3 rounded border shadow-5 hover:bg-gray-100 w-full text-center"
  >
    <i :class="icon" class="text-xl"></i>
    <span class="text-sm">{{ label }}</span>
  </button>
</template>

<script setup>
defineProps({
  icon: String,
  label: String,
  
})
</script>
