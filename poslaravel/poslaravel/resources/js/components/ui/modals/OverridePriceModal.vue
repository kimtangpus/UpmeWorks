<script setup lang="ts">
import { ref } from 'vue';
import ModalTemplate from './modal-templates/ModalTemplate.vue';
import ModalHeaderTemplate from './modal-templates/ModalHeaderTemplate.vue';

const props = defineProps({
    show: Boolean
})

const emit = defineEmits(['close'])

const handleClose = () => {
    emit('close')
}
</script>

<template>
    <Teleport to="body">
        <ModalTemplate :show="show" @closeModal="handleClose">
            <template #header>
                <ModalHeaderTemplate title="Override Price" description="Set a new price for this product" icon="fas fa-certificate" @close="handleClose" />
            </template>
            <template #body>
                <form class="p-4" @submit.prevent v-motion :initial="{ opacity: 0, y: 20 }"
                    :enter="{ opacity: 1, y: 0, transition: { duration: 300, delay: 200 } }">
                    <div class="space-y-6">

                        <div class="flex items-center gap-2">
                            <label for="product" class="text-sm font-medium w-24 text-gray-600">
                                Product:
                            </label>
                            <input type="text" id="product"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 flex-1"
                                placeholder="Beef Buffalo" disabled />
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="number" id="price"
                                class="bg-white text-center placeholder:text-center border-2 border-gray-200 text-5xl rounded-xl font-bold text-(--upme-dark-green) focus:ring-gray-600 focus:border-gray-200 w-full h-2xl py-6 px-4"
                                placeholder="0.00" step="0.25" min="0" />
                        </div>

                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="w-full text-white bg-(--button-green) hover:opacity-80 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center transition-all"
                            v-motion :initial="{ opacity: 0, y: 20 }"
                            :enter="{ opacity: 1, y: 0, transition: { duration: 300, delay: 300 } }"
                            :hover="{ scale: 1.02 }" :tap="{ scale: 0.98 }">
                            Apply Override
                        </button>
                    </div>

                </form>
            </template>
        </ModalTemplate>
    </Teleport>
</template>