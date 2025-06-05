<script setup lang="ts">
import { useDateTime } from '@/composables/useDateTime';

defineProps({
    currentTime: String,
    currentDate: String
})


const { currentDate, currentTime } = useDateTime();

</script>

<template>
    <footer
        class="bg-(--upme-light-green) text-(--upme-dark-green) text-xs py-2 px-4 fixed bottom-0 left-0 w-full z-50 flex justify-between items-center">
        <div class="font-bold">
            © 2025 UPme Works. All rights reserved.
        </div>
        <div class="font-medium">
            {{ currentDate }} {{ currentTime }}
        </div>
    </footer>
</template>