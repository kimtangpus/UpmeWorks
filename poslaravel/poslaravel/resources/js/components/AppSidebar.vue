<script setup lang="ts">
import CategoryButton from '@/components/CategoryButton.vue'

defineProps({
    categories: Object,
    selectedCategoryId: Number
})

const emit = defineEmits(['update:selectedCategoryId'])

const selectCategory = (id: number) => {
    emit('update:selectedCategoryId', id)
}


</script>

<template>
    <aside class="w-60 bg-white flex flex-col h-[calc(100vh-32px)]">
        <div class="p-4 flex-shrink-0">
            <img src="/servelogo.png" alt="Logo" class="h-20 mx-auto mb-4" />
        </div>
        
        <div class="flex-1 overflow-y-auto px-4">
            <div class="space-y-2">
                <CategoryButton
                    v-for="category in categories"
                    :key="category.id"
                    :label="category.name"
                    @click="selectCategory(category.id)"
                    :class="[
                        'w-full text-left px-4 py-2 rounded-lg font-semibold',
                        selectedCategoryId === category.id ? 'bg-[#c9e4b3]' : 'hover:bg-[#dcedc8]'
                    ]"
                    :isActive="selectedCategoryId === category.id"
                />
            </div>
        </div>
    </aside>
</template>
