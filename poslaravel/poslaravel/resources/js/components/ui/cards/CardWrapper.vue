<script setup lang="ts">
</script>

<template>
    <div class="flex flex-col bg-gray-100 rounded-lg border border-gray-400 p-4">

        <div v-if="$slots.header" class="mb-4">
            <slot name="header" />
        </div>

        <div v-if="$slots.body" class="flex-1">
            <slot name="body" />
        </div>

        <div v-if="$slots.footer" class="mt-4">
            <slot name="footer" />
        </div>

    </div>
</template>
