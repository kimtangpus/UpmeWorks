<script setup lang="ts">
import SimpleButton from '../buttons/SimpleButton.vue';
import CardWithInlineTitle from '../cards/CardWithInlineTitle.vue';
import ModalHeaderTemplate from './modal-templates/ModalHeaderTemplate.vue';
import ModalTemplate from './modal-templates/ModalTemplate.vue';


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
                <ModalHeaderTemplate title="Split Table" icon="fas fa-arrows-split-up-and-left" />
            </template>

            <template #body>
                <!-- Modal Body -->
                <div class="flex gap-4 px-6 py-4">
                    <!-- Source Table Card -->


                    <CardWithInlineTitle title="Source Table" icon="fas fa-table">
                        <template #body>
                            <div class="p-4">
                                <div
                                    class="text-3xl font-bold text-white text-center rounded border border-(--upme-dark-green) bg-(--card-green) py-2">
                                    1,872.00
                                </div>

                                <div class="mt-4 border rounded">
                                    <div
                                        class="grid grid-cols-3 bg-gray-100 text-center text-sm font-semibold text-gray-700">
                                        <div class="p-2 col-span-2">Menu Description</div>
                                        <div class="p-2">QTY</div>
                                    </div>

                                    <!-- Insert Source Table here -->
                                    <div class="grid grid-cols-3 text-center border-t text-sm">
                                        <div class="p-2 col-span-2">Item Name</div>
                                        <div class="p-2 flex justify-between items-center">
                                            1
                                            <i
                                                class="fas fa-share cursor-pointer text-gray-500 hover:text-upme-dark-green"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </CardWithInlineTitle>

                    <!-- Split Table Card -->

                    <CardWithInlineTitle title="Split Table" icon="fas fa-random">
                        <template #body>
                            <div class="p-4">
                                <div class="text-3xl font-bold text-center rounded bg-[#CAE0BC] py-2"
                                    style="color: var(--upme-dark-green); opacity: 0.5;">
                                    0.00
                                </div>

                                <!-- InsertTable for split table here -->
                                <div class="mt-4 border rounded">
                                    <div
                                        class="grid grid-cols-3 bg-gray-100 text-center text-sm font-semibold text-gray-700">
                                        <div class="p-2 col-span-2">Menu Description</div>
                                        <div class="p-2">QTY</div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </CardWithInlineTitle>
                </div>

            </template>

            <template #footer>
                <div class="flex justify-between gap-4 px-12 pb-6 items-center">
                    <!-- Reset Button -->
                    <SimpleButton
                        class="flex-1 border border-yellow-200 bg-yellow-50 text-yellow-700 font-semibold py-2 rounded hover:bg-yellow-100"
                        text="Reset" />

                    <!-- Cancel and Split Buttons -->
                    <div class="flex flex-1 gap-2">
                        <SimpleButton
                            class="w-full border border-gray-300 py-2 rounded hover:bg-gray-100 text-(--upme-dark-green)"
                            text="Cancel" />
                        <SimpleButton
                            class="w-full bg-(--button-green) text-white py-2 rounded hover:bg-(--selected-button-green)"
                            text="Split Table" />
                    </div>
                </div>
            </template>




        </ModalTemplate>
    </Teleport>

</template>