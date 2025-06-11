<template>
    <div v-if="show" ref="popoverRef"
        class="fixed bottom-[60px] right-[160px] bg-white shadow-lg rounded-lg p-2 min-w-[200px] z-50 text-(--upme-dark-green)">
        <div class="flex flex-col gap-2">
            <SimpleButton text="Table Maintenance" class="text-start font-medium hover:bg-gray-100" />
            <SimpleButton text="Storage Areas" class="text-start font-medium hover:bg-gray-100" />
            <SimpleButton text="Customers" class="text-start font-medium hover:bg-gray-100" />
            <SimpleButton text="Charges" class="text-start font-medium hover:bg-gray-100" />
            <SimpleButton text="Expense Group" class="text-start font-medium hover:bg-gray-100" />
            <SimpleButton text="POS Maintenance" class="text-start font-medium hover:bg-gray-100" />
            <SimpleButton text="Storage Configuration" class="text-start font-medium hover:bg-gray-100" />
        </div>
    </div>
</template>
  
<script setup lang="ts">
import { ref } from 'vue'
import SimpleButton from '../buttons/SimpleButton.vue';
import { useClickOutside } from '@/composables/useClickOutside';

const props = defineProps<{ show: boolean }>()
const emit = defineEmits<{
    (e: 'close'): void
}>()

const popoverRef = ref<HTMLElement | null>(null)

useClickOutside(popoverRef, () => emit('close'))


</script>
