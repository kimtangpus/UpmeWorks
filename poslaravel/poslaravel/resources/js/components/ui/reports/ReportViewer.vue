<script setup lang="ts">
import ButtonIcon from '../buttons/ButtonIcon.vue';


</script>


<template>
    <div class="flex flex-col">
        <div class="flex flex-col border border-gray-200 rounded-lg bg-[#F0F0F0]">
            <!-- Toolbar -->
            <div
                class="flex items-center px-3 py-2 border-b border-gray-200 bg-gray-50 rounded-t-lg text-(--upme-dark-green)">
                <ButtonIcon title="Print" icon="fas fa-print" />
                <ButtonIcon title="Print Two" icon="fas fa-print" />
                <ButtonIcon title="Copy" icon="fas fa-copy" />

                <div class="w-px h-5 bg-gray-300 mx-2"></div>

                <ButtonIcon title="Full Back" icon="fas fa-angle-double-left" />
                <ButtonIcon title="Back" icon="fas fa-angle-left" />
                <ButtonIcon title="Forawrd" icon="fas fa-angle-right" />
                <ButtonIcon title="Full Forward" icon="fas fa-angle-double-right" />

                <div class="w-px h-5 bg-gray-300 mx-2"></div>

                <input type="text" class="border rounded ml-2 px-2 py-1 w-40 text-sm" placeholder="Search..." />

                <ButtonIcon title="Zoom out" icon="fas fa-search-minus" />
                <ButtonIcon title="Zoom in" icon="fas fa-search-plus" />
            </div>

            <!-- Scrollable Report Content -->
            <div class="flex-1 overflow-auto px-4 py-2 bg-white h-[500px]">
                <!-- Place report content here -->
            </div>

        </div>

        <div class="flex justify-between items-center text-xs text-(--upme-dark-green) py-2">
            <span>Current Page No.:</span>
            <span>Total Page No.:</span>
            <span>Zoom Factor: 100%</span>
        </div>
    </div>
</template>