<script setup lang="ts">
import { ref } from 'vue';
import ModalTemplate from './ModalTemplate.vue';

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
                <div class="flex items-center justify-between p-4 border-b border-gray-200" v-motion
                    :initial="{ opacity: 0, y: -20 }"
                    :enter="{ opacity: 1, y: 0, transition: { duration: 300, delay: 100 } }">
                    <div class="flex items-center text-(--upme-dark-green) gap-3">
                        <i class="text-[24px] fas fa-certificate"></i>
                        <div>
                            <h3 class="text-lg font-semibold">
                                Override Price
                            </h3>
                            <p class="text-sm mt-0.5">
                                Set a new price for this product
                            </p>
                        </div>
                    </div>

                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        @click="handleClose" v-motion :initial="{ scale: 0.8, opacity: 0 }"
                        :enter="{ scale: 1, opacity: 1, transition: { duration: 200, delay: 200 } }"
                        :hover="{ scale: 1.1 }">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
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