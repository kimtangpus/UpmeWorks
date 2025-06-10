<script setup lang="ts">
import ModalTemplate from './modal-templates/ModalTemplate.vue';
import ModalHeaderTemplate from './modal-templates/ModalHeaderTemplate.vue';
import SimpleButton from '../buttons/SimpleButton.vue';
import CardWrapper from '../cards/CardWrapper.vue';

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
                <ModalHeaderTemplate title="Apply Discount" description="Apply discount to orders" icon="fas fa-certificate" @close="handleClose" />
            </template>
            <template #body>
                <form class="p-4" @submit.prevent v-motion :initial="{ opacity: 0, y: 20 }"
                    :enter="{ opacity: 1, y: 0, transition: { duration: 300, delay: 200 } }">
                    <div class="space-y-6">

                        <div class="flex items-center gap-2">
                            <label for="customerNum"
                                class="text-sm font-medium whitespace-nowrap w-40 text-(--upme-dark-green)">
                                No. of Customers:
                            </label>
                            <input type="number" id="customerNum"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded p-2.5 w-1/2"
                                placeholder="1" />
                        </div>

                        <div class="flex items-center gap-2">
                            <label for="seniorPwdId"
                                class="text-sm font-medium whitespace-nowrap w-40 text-(--upme-dark-green)">
                                Senior Citizen/PWD ID:
                            </label>
                            <input type="text" id="seniorPwdId"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded p-2.5 w-1/2"
                                placeholder="e.g. PWD/SC-02-2023-01234" />
                        </div>


                        <div class="grid grid-cols-2 gap-4">
                            <!-- Left Column -->
                            <div class="flex flex-col justify-between space-y-4">
                                <!-- Discount Type Card -->

                                <CardWrapper>
                                    <template #header>
                                        <h2 class="text-(--upme-dark-green) font-bold">Discount Type</h2>
                                    </template>

                                    <template #body>
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
                                    </template>
                                </CardWrapper>

                                <!-- Percentage Input -->
                                <div class="flex flex-col space-y-2">
                                    <label for="percentage" class="text-(--upme-dark-green) font-semibold">
                                        Percentage
                                    </label>
                                    <input id="percentage" type="number" placeholder="Enter percentage"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded p-2.5" />
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="flex flex-col justify-between space-y-4">
                                <!-- Discount Factor Card -->

                                <CardWrapper>
                                    <template #header>
                                        <h2 class="text-(--upme-dark-green) font-bold">Discount Factor</h2>
                                    </template>

                                    <template #body>
                                        <div class="grid grid-cols-2 gap-3">
                                            <button
                                                class="col-span-2 w-full shadow font-medium py-3 px-4 rounded bg-white hover:bg-gray-200 transition text-(--upme-dark-green) text-sm min-h-[48px]">
                                                Percent Discount
                                            </button>
                                            <button
                                                class="col-span-2 w-full shadow font-medium py-3 px-4 rounded bg-white hover:bg-gray-200 transition text-(--upme-dark-green) text-sm min-h-[48px]">
                                                Peso Discount
                                            </button>
                                        </div>
                                    </template>

                                </CardWrapper>

                                <!-- Discounted Amount Input -->
                                <div class="flex flex-col space-y-2">
                                    <label for="discountedAmount" class="text-(--upme-dark-green) font-semibold">
                                        Discounted Amount
                                    </label>
                                    <input id="discountedAmount" type="number" placeholder="Enter discounted amount"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded p-2.5" />
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class=" mt-6">
                        <SimpleButton type="submit"
                            class="w-full text-white bg-(--button-green) hover:opacity-80 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center transition-all"
                            v-motion :initial="{ opacity: 0, y: 20 }"
                            :enter="{ opacity: 1, y: 0, transition: { duration: 300, delay: 300 } }"
                            :hover="{ scale: 1.02 }" :tap="{ scale: 0.98 }" text="Apply Discount" />
                    </div>

                </form>
            </template>
        </ModalTemplate>
    </Teleport>
</template>