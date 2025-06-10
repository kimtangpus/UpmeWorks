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
                <ModalHeaderTemplate title="Total Payables" description="Settle your transaction" icon="fas fa-wallet" @close="handleClose" />
            </template>
            <template #body>
                <div class="flex gap-4 px-4 py-4">
                    <div class="flex flex-col flex-1">
                        <CardWithInlineTitle title="₱ 1,805.14" class="flex-1">
                            <div class="flex flex-col space-y-2 flex-1 w-[225px]">
                                <SimpleButton class="w-full shadow border border-gray-200 py-2 rounded hover:bg-gray-100"
                                    text="Cash" />
                                <SimpleButton class="w-full shadow border border-gray-200 py-2 rounded hover:bg-gray-100"
                                    text="Debit/Credit Card" />
                                <SimpleButton class="w-full shadow border border-gray-200 py-2 rounded hover:bg-gray-100"
                                    text="Gcash" />
                                <SimpleButton class="w-full shadow border border-gray-200 py-2 rounded hover:bg-gray-100"
                                    text="Complimentary" />
                                <SimpleButton class="w-full shadow border border-gray-200 py-2 rounded hover:bg-gray-100"
                                    text="Personal Check" />
                                <SimpleButton class="w-full shadow border border-gray-200 py-2 rounded hover:bg-gray-100"
                                    text="Food Panda" />
                                <SimpleButton class="w-full shadow border border-gray-200 py-2 rounded hover:bg-gray-100"
                                    text="Customer Account" />
                                <SimpleButton class="w-full shadow border border-gray-200 py-2 rounded hover:bg-gray-100"
                                    text="Grab Food" />
                            </div>
    
                        </CardWithInlineTitle>

                        <div class="mt-2 text-(--upme-dark-green)">
                            <label class="text-sm font-semibold block mb-1">Particulars</label>
                            <select class="w-full border rounded px-2">
                                <option value="">Select Particular</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Tendered Amount + Calculator -->
                    <div class="rounded-lg bg-gray-100 p-4 flex flex-col text-(--upme-dark-green)">
                        <div class="bg-[#E14B4B] text-white px-3 py-1 rounded text-center font-semibold mb-2">
                            Amount Tendered
                        </div>
                        <input type="text" class="border border-gray-200 rounded px-3 py-2 mb-2 bg-white"
                            value="0.00" readonly />

                        <div class="text-4xl text-white font-bold bg-[#343434] text-center py-4 rounded mb-4 ">
                            345.00 <div class="text-sm font-normal">Total change</div>
                        </div>

                        <div class="flex flex-grow gap-4">
                            <div class="grid grid-cols-5 grid-rows-6 gap-2 w-full max-w-md text-(--upme-dark-green)">
                                <!-- Denomination Buttons (Columns 1-2) -->
                                <SimpleButton class="border border-gray-200 bg-white py-2 rounded hover:bg-gray-100 font-semibold col-start-1 row-start-1" text="20" />
                                <SimpleButton class="border border-gray-200 bg-white py-2 rounded hover:bg-gray-100 font-semibold col-start-2 row-start-1" text="1000" />
                                <SimpleButton class="border border-gray-200 bg-white py-2 rounded hover:bg-gray-100 font-semibold col-start-1 row-start-2" text="50" />
                                <SimpleButton class="border border-gray-200 bg-white py-2 rounded hover:bg-gray-100 font-semibold col-start-2 row-start-2" text="2000" />
                                <SimpleButton class="border border-gray-200 bg-white py-2 rounded hover:bg-gray-100 font-semibold col-start-1 row-start-3" text="100" />
                                <SimpleButton class="border border-gray-200 bg-white py-2 rounded hover:bg-gray-100 font-semibold col-start-2 row-start-3" text="3000" />
                                <SimpleButton class="border border-gray-200 bg-white py-2 rounded hover:bg-gray-100 font-semibold col-start-1 row-start-4" text="200" />
                                <SimpleButton class="border border-gray-200 bg-white py-2 rounded hover:bg-gray-100 font-semibold col-start-2 row-start-4" text="4000" />
                                <SimpleButton class="border border-gray-200 bg-white py-2 rounded hover:bg-gray-100 font-semibold col-start-1 row-start-5" text="500" />
                                <SimpleButton class="border border-gray-200 bg-white py-2 rounded hover:bg-gray-100 font-semibold col-start-2 row-start-5" text="5000" />
                                <SimpleButton class="border border-gray-200 bg-white py-2 rounded hover:bg-gray-100 font-semibold col-start-1 col-span-2 row-start-6" text="Pay Exact Amount" />

                                <!-- Numeric Keypad (Columns 3-5) -->
                                <SimpleButton class="border border-(--button-green) rounded py-2 bg-(--calc-button-green) hover:bg-(--calc-hover-button-green) col-start-3 row-start-1" text="1" />
                                <SimpleButton class="border border-(--button-green) rounded py-2 bg-(--calc-button-green) hover:bg-(--calc-hover-button-green) col-start-4 row-start-1" text="2" />
                                <SimpleButton class="border border-(--button-green) rounded py-2 bg-(--calc-button-green) hover:bg-(--calc-hover-button-green) col-start-5 row-start-1" text="3" />

                                <SimpleButton class="border border-(--button-green) rounded py-2 bg-(--calc-button-green) hover:bg-(--calc-hover-button-green) col-start-3 row-start-2" text="4" />
                                <SimpleButton class="border border-(--button-green) rounded py-2 bg-(--calc-button-green) hover:bg-(--calc-hover-button-green) col-start-4 row-start-2" text="5" />
                                <SimpleButton class="border border-(--button-green) rounded py-2 bg-(--calc-button-green) hover:bg-(--calc-hover-button-green) col-start-5 row-start-2" text="6" />

                                <SimpleButton class="border border-(--button-green) rounded py-2 bg-(--calc-button-green) hover:bg-(--calc-hover-button-green) col-start-3 row-start-3" text="7" />
                                <SimpleButton class="border border-(--button-green) rounded py-2 bg-(--calc-button-green) hover:bg-(--calc-hover-button-green) col-start-4 row-start-3" text="8" />
                                <SimpleButton class="border border-(--button-green) rounded py-2 bg-(--calc-button-green) hover:bg-(--calc-hover-button-green) col-start-5 row-start-3" text="9" />

                                <SimpleButton class="border border-(--button-green) rounded py-2 bg-(--calc-button-green) hover:bg-(--calc-hover-button-green) col-start-3 row-start-4" text="⌫" />
                                <SimpleButton class="border border-(--button-green) rounded py-2 bg-(--calc-button-green) hover:bg-(--calc-hover-button-green) col-start-4 row-start-4" text="0" />
                                <SimpleButton class="border border-(--button-green) rounded py-2 bg-(--calc-button-green) hover:bg-(--calc-hover-button-green) col-start-5 row-start-4" text="C" />

                                <!-- Confirm Payment Button (spans cols 3-5 and rows 5-6) -->
                                <SimpleButton
                                    class="col-start-3 col-span-3 row-start-5 row-span-2 text-xl font-bold py-8 border border-(--button-green) rounded bg-(--calc-button-green) hover:bg-(--calc-hover-button-green)"
                                    text="Confirm Payment"
                                />
                            </div>

                        </div>
                    </div>
                </div>
            </template>
        </ModalTemplate>
    </Teleport>
</template>