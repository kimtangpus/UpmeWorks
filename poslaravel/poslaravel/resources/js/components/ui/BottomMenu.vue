<template>
    <div>
        <nav class="bg-white shadow-md border-grey-200 fixed bottom-[32px] left-0 w-full z-40 flex flex-wrap justify-center text-(--dark-green) p-2 gap-4">
            <BottomMenuButton icon="fas fa-circle-play" label="Start Day" />
            <BottomMenuButton icon="fas fa-stop" label="End Day" />
            <BottomMenuButton icon="fas fa-file-invoice-dollar" label="Show Orders" />
            <BottomMenuButton icon="fas fa-percent" label="Apply Discount" />
            <BottomMenuButton icon="fas fa-cash-register" label="Bill Out" />
            <BottomMenuButton icon="fas fa-arrow-down-up-across-line" label="Transfer Table" />
            <BottomMenuButton icon="fas fa-file-invoice-dollar" label="Refunds" />
            <BottomMenuButton icon="fas fa-divide" label="Split Bill" />
            <BottomMenuButton icon="fas fa-print" label="Print X-Report" />
            <BottomMenuButton icon="fas fa-print" label="Print Z-Report" />
            <BottomMenuButton icon="fas fa-file" label="Reports" />
            <BottomMenuButton icon="fas fa-clipboard" label="Back Office" />
        </nav>

        <div
            class="bg-(--light-green) text-(--dark-green) text-xs py-2 px-4 fixed bottom-0 left-0 w-full z-50 flex justify-between items-center">
            <div class="font-bold">
                © 2025 UPme Works. All rights reserved.
            </div>
            <div class="font-medium">
                {{ currentDate }} {{ currentTime }}
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import BottomMenuButton from './bottom-menu/BottomMenuButton.vue';

defineProps({
    currentTime: String,
    currentDate: String
})


</script>