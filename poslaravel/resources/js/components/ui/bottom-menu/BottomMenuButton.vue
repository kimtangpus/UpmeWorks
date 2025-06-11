<template>
  <Link v-if="href" :href="href"
    class="flex flex-col items-center justify-center gap-1 p-3 flex-1 min-w-[100px] min-h-[100px] items-stretch text-center rounded shadow-5 border border-gray-100 shadow hover:bg-gray-100 text-center cursor-pointer">
  <i :class="icon" class="text-[24px]"></i>
  <span class="text-sm font-bold">{{ label }}</span>
  </Link>

  <button v-else @click="$emit('click')"
    class="flex flex-col items-center justify-center gap-1 p-3 flex-1 min-w-[100px] min-h-[100px] items-stretch text-center rounded shadow-5 border border-gray-100 shadow hover:bg-gray-100 text-center cursor-pointer">
    <i :class="icon" class="text-[24px]"></i>
    <span class="text-sm font-bold">{{ label }}</span>
  </button>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  icon: String,
  label: String,
  href: String
})
</script>
