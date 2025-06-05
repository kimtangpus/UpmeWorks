<template>
  <!-- <router-link
      v-if="to"
      :to="to"
      class="flex flex-col w-[100px] h-[100px] items-center gap-1 p-3 rounded hover:bg-gray-100 cursor-pointer text-center"
    >
    <i :class="icon" class="text-xl"></i>
      <span class="text-sm">{{ label }}</span>
    </router-link> -->

  <button @click="$emit('click')"
    class="flex flex-col items-center justify-center gap-1 p-3 flex-1 min-w-[100px] min-h-[100px] items-stretch text-center rounded shadow-5 border border-gray-300 hover:bg-gray-100 text-center cursor-pointer">
    <i :class="icon" class="text-[24px]"></i>
    <span class="text-sm">{{ label }}</span>
  </button>

</template>
  
<script setup>
defineProps({
    icon: String,
    label: String,
})
</script>
