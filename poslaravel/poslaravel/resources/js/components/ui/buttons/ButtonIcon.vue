<script setup lang="ts">
defineProps<{
    icon: string
    title: string
}>()
</script>

<template>
    <button type="button" :title="title" :aria-label="title"
        class="p-2 rounded-lg transition cursor-pointer group relative" 
        >
        <i :class="[icon]"></i> 
        
        <div class="absolute top-full left-1/2 -translate-x-1/2 mt-2 px-2 py-1 bg-white  text-xs rounded whitespace-nowrap opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity">
            {{ title }}
        </div>
    </button>
</template>
