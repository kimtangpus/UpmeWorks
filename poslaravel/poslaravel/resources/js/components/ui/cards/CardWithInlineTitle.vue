<script setup lang="ts">
import { defineProps } from 'vue'

const props = defineProps<{
    title: string
    icon?: string
    class?: string
}>()
</script>

<template>
    <div class="flex-1 border border-gray-300 rounded-lg relative bg-white text-(--upme-dark-green)"
        :class="props.class">
        <div class="absolute -top-3 left-4 bg-white px-2 font-semibold flex items-center gap-2">
            <i v-if="icon" :class="icon"></i>
            {{ title }}
        </div>

        <div class="p-4 pt-8">
            <div v-if="$slots.header" class="mb-4">
                <slot name="header" />
            </div>
            <div v-if="$slots.body" class="flex-1">
                <slot name="body" />
            </div>
            <slot />
            <div v-if="$slots.footer" class="mt-4">
                <slot name="footer" />
            </div>
        </div>
    </div>
</template>
