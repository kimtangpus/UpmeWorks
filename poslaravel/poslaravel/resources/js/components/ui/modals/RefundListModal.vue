<script setup lang="ts">
import { ref } from 'vue';
import ModalTemplate from './modal-templates/ModalTemplate.vue';
import ButtonIcon from '../buttons/ButtonIcon.vue';
import SimpleButton from '../buttons/SimpleButton.vue';
import DataTable from '../tables/DataTable.vue';
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
                <ModalHeaderTemplate title="Refund List" description="Add/edit record information"
                    icon="fas fa-certificate" @close="handleClose" />
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