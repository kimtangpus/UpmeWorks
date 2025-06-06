<script setup lang="ts">
import { ref } from 'vue';
import ModalTemplate from './ModalTemplate.vue';
import SimpleButton from '../buttons/SimpleButton.vue';

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
                                Apply Discount
                            </h3>
                            <p class="text-sm mt-0.5">
                                Apply discount to orders
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
                            <label for="customerNum" class="text-sm font-medium w-24 text-(--upme-dark-green)">
                                No. of Customer:
                            </label>
                            <input type="number" id="customerNum"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 flex-1"
                                placeholder="1" />
                        </div>

                        <div class="flex items-center gap-2">
                            <label for="seniorPwdId" class="text-sm font-medium w-24 text-(--upme-dark-green)">
                                Senior Citizen/PWD ID:
                            </label>
                            <input type="text" id="seniorPwdId"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 flex-1"
                                placeholder="e.g. PWD/SC-02-2023-01234" />
                        </div>

                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <!-- Left Column -->
                            <div class="flex flex-col space-y-4">
                                <!-- Discount Type Card -->
                                <div class="flex flex-col bg-gray-100 rounded-lg p-4 border border-gray-400 rounded">
                                    <h2 class="text-[var(--upme-dark-green)] font-bold mb-4">Discount Type</h2>
                                    <div class="grid grid-cols-2 gap-2">
                                        <button
                                            class="w-full shadow font-medium py-2 px-2 rounded bg-white hover:bg-gray-200 transition text-[var(--upme-dark-green)] text-xs min-h-[48px] leading-tight text-center">
                                            Special Discount
                                        </button>
                                        <button
                                            class="w-full shadow font-medium py-2 px-2 rounded bg-white hover:bg-gray-200 transition text-[var(--upme-dark-green)] text-xs min-h-[48px] leading-tight text-center">
                                            Transaction Discount
                                        </button>
                                        <button
                                            class="w-full shadow font-medium py-2 px-2 rounded bg-white hover:bg-gray-200 transition text-[var(--upme-dark-green)] text-xs min-h-[48px] leading-tight text-center">
                                            Senior Discount
                                        </button>
                                        <button
                                            class="w-full shadow font-medium py-2 px-2 rounded bg-white hover:bg-gray-200 transition text-[var(--upme-dark-green)] text-xs min-h-[48px] leading-tight text-center">
                                            PWD Discount
                                        </button>
                                    </div>
                                </div>

                                <!-- Percentage Input -->
                                <div class="flex flex-col space-y-2">
                                    <label for="percentage" class="text-[var(--upme-dark-green)] font-semibold">
                                        Percentage
                                    </label>
                                    <input id="percentage" type="number" placeholder="Enter percentage"
                                        class="w-full border border-gray-300 rounded px-3 py-3 focus:outline-none focus:ring-2 focus:ring-green-300 min-h-[48px]" />
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="flex flex-col space-y-4">
                                <!-- Discount Factor Card -->
                                <div class="flex flex-col bg-gray-100 rounded-lg p-4 border border-gray-400 rounded">
                                    <h2 class="text-[var(--upme-dark-green)] font-bold mb-4">Discount Factor</h2>
                                    <div class="grid grid-cols-2 gap-3">
                                        <button
                                            class="col-span-2 w-full shadow font-medium py-3 px-4 rounded bg-white hover:bg-gray-200 transition text-[var(--upme-dark-green)] text-sm min-h-[48px]">
                                            Percent Discount
                                        </button>
                                        <button
                                            class="col-span-2 w-full shadow font-medium py-3 px-4 rounded bg-white hover:bg-gray-200 transition text-[var(--upme-dark-green)] text-sm min-h-[48px]">
                                            Peso Discount
                                        </button>
                                    </div>
                                </div>

                                <!-- Discounted Amount Input -->
                                <div class="flex flex-col space-y-2">
                                    <label for="discountedAmount" class="text-[var(--upme-dark-green)] font-semibold">
                                        Discounted Amount
                                    </label>
                                    <input id="discountedAmount" type="number" placeholder="Enter discounted amount"
                                        class="w-full border border-gray-300 rounded px-3 py-3 focus:outline-none focus:ring-2 focus:ring-green-300 min-h-[48px]" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6">
                        <SimpleButton 
                            type="submit"
                            class="w-full text-white bg-(--button-green) hover:opacity-80 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center transition-all"
                            v-motion :initial="{ opacity: 0, y: 20 }"
                            :enter="{ opacity: 1, y: 0, transition: { duration: 300, delay: 300 } }"
                            :hover="{ scale: 1.02 }" :tap="{ scale: 0.98 }"
                            text="Apply Discount"
                        />
                    </div>

                </form>
            </template>
        </ModalTemplate>
    </Teleport>
</template>