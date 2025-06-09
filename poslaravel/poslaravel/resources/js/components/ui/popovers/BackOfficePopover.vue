<template>
    <div v-if="show" class="fixed bottom-[120px] right-[calc(100%-200px)] bg-white shadow-lg rounded-lg p-2 min-w-[200px] z-50">
        <div class="flex flex-col gap-2">
            <button 
                v-for="(item, index) in menuItems" 
                :key="index"
                @click="item.action"
                class="flex items-center gap-2 px-4 py-2 text-left hover:bg-gray-100 rounded-md text-(--upme-dark-green)"
            >
                <i :class="item.icon" class="w-5"></i>
                <span>{{ item.label }}</span>
            </button>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';

const props = defineProps<{
    show: boolean
}>();

const emit = defineEmits<{
    (e: 'close'): void
}>();

const menuItems = [
    {
        label: 'Inventory',
        icon: 'fas fa-boxes',
        action: () => {
            // TODO: Add inventory modal trigger
            emit('close');
        }
    },
    {
        label: 'Employees',
        icon: 'fas fa-users',
        action: () => {
            // TODO: Add employees modal trigger
            emit('close');
        }
    },
    {
        label: 'Settings',
        icon: 'fas fa-cog',
        action: () => {
            // TODO: Add settings modal trigger
            emit('close');
        }
    }
];
</script> 