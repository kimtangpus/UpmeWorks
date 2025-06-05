<template>
    <div>
        <nav
            class="bg-white shadow-md border-grey-200 fixed bottom-[32px] left-0 w-full z-40 flex flex-wrap justify-center text-(--upme-dark-green) p-2 gap-4">
            <BottomMenuButton icon="fas fa-circle-play" label="Start Day" />
            <BottomMenuButton icon="fas fa-stop" label="End Day" />
            <BottomMenuButton href="/show-orders" icon="fas fa-file-invoice-dollar" label="Show Orders" />
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
    </div>
</template>

<script setup lang="ts">
import BottomMenuButton from '@/components/ui/bottom-menu/BottomMenuButton.vue';

</script>