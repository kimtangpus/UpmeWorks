<script setup lang="ts">
import { ref } from 'vue';
import ModalTemplate from './ModalTemplate.vue';
import ButtonIcon from '../buttons/ButtonIcon.vue';
import SimpleButton from '../buttons/SimpleButton.vue';
import DataTable from '../tables/DataTable.vue';

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
                        <i class="text-[24px] fas fa-clipboard-list"></i>
                        <div>
                            <h3 class="text-lg font-semibold">
                                Refund List
                            </h3>
                            <p class="text-sm mt-0.5">
                                Add/edit record information
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

                <div class="flex flex-col gap-2">
                    <div class="flex justify-between items-center text-[var(--upme-dark-green)] space-x-4">
                        <SimpleButton
                            class="p-2 rounded-lg bg-white hover:bg-gray-100 shadow transition flex items-center gap-2 cursor-pointer"
                            text="Add new item" icon="fas fa-plus" />
                        <div class="relative w-1/2">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input value="" type="text" placeholder="Search here"
                                class="p-2 pl-10 border border-[#d0e0cd] rounded-xl w-full shadow-sm focus:outline-none text-[#2e3c2f]" />
                        </div>
                    </div>

                    <div class="rounded-xl border-gray-200">
                        <table class="w-full border border-gray-00 rounded-xl text-xs">
                            <thead class="bg-gray-100 text-[var(--upme-dark-green)]">
                                <tr>
                                    <th class="border border-gray-300 rounded-lg px-4 py-2 text-left">Trans No.</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Doc Date</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Amount</th>
                                    <th class="border border-gray-300 px-2 py-2 w-12"></th>
                                    <th class="border border-gray-300 px-2 py-2 w-12"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="i in 12" :key="i" class="hover:bg-gray-50">
                                    <td class="border border-gray-300 px-4 py-2 text-(--upme-dark-green)">Lorem ipsum
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-(--upme-dark-green)">Lorem ipsum
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-(--upme-dark-green)">Lorem ipsum
                                    </td>
                                    <td class="border border-gray-300 px-2 py-2 text-center text-(--upme-dark-green)">
                                        <ButtonIcon icon="fas fa-pencil" title="edit"
                                            class="text-(--upme-dark-green)" />
                                    </td>
                                    <td class="border border-gray-300 px-2 py-2 text-center">
                                        <ButtonIcon icon="fas fa-trash" title="delete" class="text-red-800" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>


            </template>
        </ModalTemplate>
    </Teleport>
</template>