<template>
    <router-link
      v-if="to"
      :to="to"
      class="flex flex-col w-[100px] h-[100px] items-center gap-1 p-3 rounded hover:bg-gray-100 cursor-pointer text-center"
    >
    <i :class="icon" class="text-xl"></i>
      <span class="text-sm">{{ label }}</span>
    </router-link>
  
    <button
      v-else
      @click="$emit('click')"
      class="flex flex-col w-[100px] h-[100px] items-center gap-1 p-3 rounded shadow-5 border border-gray-300 hover:bg-gray-100 w-full text-center"
    >
      <i :class="icon" class="text-[30px] w-[30px] h-[30px] flex items-center justify-center"></i>
      <span class="text-sm">{{ label }}</span>
    </button>
</template>
  
<script setup>
defineProps({
    icon: String,
    label: String,
})
</script>
