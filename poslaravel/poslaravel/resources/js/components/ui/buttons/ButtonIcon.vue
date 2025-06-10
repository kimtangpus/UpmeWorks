<script setup lang="ts">
defineProps<{
    icon: string
    title: string
}>()
</script>
<template>
    <button type="button" :title="title" :aria-label="title"
        class="p-2 rounded-lg transition cursor-pointer group relative">
        <i :class="[icon]"></i>

        <!-- Tooltip with arrow inside -->
        <div class="absolute top-full left-1/2 -translate-x-1/2 mt-2 px-2 py-1 bg-white text-xs rounded whitespace-nowrap
        opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity z-50 shadow">
            <div class="absolute -top-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-white rotate-45 -z-10"></div>

            {{ title }}
        </div>
    </button>
</template>
  
