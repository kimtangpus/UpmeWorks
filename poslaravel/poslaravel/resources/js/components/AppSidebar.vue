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

    <aside class="w-60 bg-[#FFFFFF] border-r flex flex-col text-[#2e3c2f]">
        <div class="p-4">
            <img src="/servelogo.png" alt="Logo" class="h-20 mx-auto mb-4" />
            
            <div class="h-150 overflow-y-auto">
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
        </div>
    </aside>


</template>
