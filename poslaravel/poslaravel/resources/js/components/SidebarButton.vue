<template>
  <router-link
    v-if="to"
    :to="to"
    class="flex flex-row items-center gap-3 p-3 rounded hover:bg-gray-100 cursor-pointer text-left w-full"
  >
    <i :class="icon" class="text-xl w-6 text-center"></i>
    <span class="text-sm font-medium">{{ label }}</span>
  </router-link>

  <button
    v-else
    @click="$emit('click')"
    class="flex flex-row items-center gap-3 p-3 rounded border shadow-sm hover:bg-gray-100 w-full text-left"
  >
    <i :class="icon" class="text-xl w-6 text-center"></i>
    <span class="text-sm font-medium">{{ label }}</span>
  </button>
</template>

<script setup>
defineProps({
  icon: String,
  label: String,
  to: String
})
</script>
