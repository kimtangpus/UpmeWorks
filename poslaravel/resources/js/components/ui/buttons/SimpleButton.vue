<script setup lang="ts">
defineProps<{
    text?: string
    icon?: string
    type?: 'button' | 'submit' | 'reset'
}>()
</script>

<template>
    <button :type="type" :title="text" :aria-label="text" class="p-2 transition cursor-pointer">
        <i :class="[icon]" v-if="icon"></i>
        {{ text }}
    </button>
</template>