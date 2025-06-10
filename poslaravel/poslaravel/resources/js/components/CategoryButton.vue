<template>
  <button
    class="flex flex-col items-center justify-center gap-1 w-full px-4 py-3 rounded font-lg shadow-sm transition-colors text-sm"
    :class="[
      isActive
        ? 'bg-[#f0f5ec] text-(--upme-dark-green)'
        : 'bg-white text-(--upme-dark-green) hover:bg-[#f0f5ec]'
    ]"
    @click="toggleActive"
  >
    <i v-if="icon" :class="icon" class="text-lg"></i>
    <span>{{ label }}</span>
  </button>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
  label: String,
  icon: String,
  modelValue: Boolean,
  isActive: Boolean 
})
const emit = defineEmits(['update:modelValue'])



</script>