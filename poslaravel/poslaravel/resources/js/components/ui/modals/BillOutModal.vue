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
                <div class="flex gap-4 px-6 py-4 h-[600px]">
                    <CardWithInlineTitle title="₱ 1,805.14">
                        <div class="space-y-2">

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

                        <div class="mt-4">
                            <label class="text-sm font-semibold block mb-1">Particulars</label>
                            <select class="w-full border rounded px-2 py-1">
                                <option value="">Select Particular</option>
                            </select>
                        </div>


                    </CardWithInlineTitle>

                    <!-- Tendered Amount + Calculator -->
                    <div class="w-2/3 rounded-lg bg-gray-100 p-4 flex flex-col text-(--upme-dark-green) ">
                        <div class="bg-[#E14B4B] text-white px-3 py-1 rounded text-center font-semibold mb-2">
                            Amount Tendered
                        </div>
                        <input type="text" class="w-full border border-gray-200 rounded px-3 py-2 mb-2 bg-white"
                            value="0.00" readonly />

                        <div class="text-4xl text-white font-bold bg-[#343434] text-center py-4 rounded mb-4">
                            345.00 <div class="text-sm font-normal">Total change</div>
                        </div>

                        <div class="flex flex-grow gap-4">
                            <div class="grid grid-cols-2 gap-2 w-1/2 font-semibold">
                                <SimpleButton
                                    class="shadow border border-gray-200 bg-white py-2 rounded hover:bg-gray-100"
                                    text="20" />
                                <SimpleButton
                                    class="shadow border border-gray-200 bg-white py-2 rounded hover:bg-gray-100"
                                    text="1000" />
                                <SimpleButton
                                    class="shadow border border-gray-200 bg-white py-2 rounded hover:bg-gray-100"
                                    text="50" />
                                <SimpleButton
                                    class="shadow border border-gray-200 bg-white py-2 rounded hover:bg-gray-100"
                                    text="2000" />
                                <SimpleButton
                                    class="shadow border border-gray-200 bg-white py-2 rounded hover:bg-gray-100"
                                    text="100" />
                                <SimpleButton
                                    class="shadow border border-gray-200 bg-white py-2 rounded hover:bg-gray-100"
                                    text="3000" />
                                <SimpleButton
                                    class="shadow border border-gray-200 bg-white py-2 rounded hover:bg-gray-100"
                                    text="200" />
                                <SimpleButton
                                    class="shadow border border-gray-200 bg-white py-2 rounded hover:bg-gray-100"
                                    text="4000" />
                                <SimpleButton
                                    class="shadow border border-gray-200 bg-white py-2 rounded hover:bg-gray-100"
                                    text="500" />
                                <SimpleButton
                                    class="shadow border border-gray-200 bg-white py-2 rounded hover:bg-gray-100"
                                    text="5000" />
                                <SimpleButton
                                    class="col-span-2 shadow border border-gray-200 bg-white py-2 rounded hover:bg-gray-100 font-semibold"
                                    text="Pay Exact Amount" />
                            </div>

                            <!-- Numeric Keypad -->
                            <div class="grid grid-cols-3 gap-2 w-1/2 text-(--upme-dark-green)">
                                <SimpleButton
                                    class="border border-(--button-green) rounded py-4 bg-(--calc-button-green) hover:bg-(--calc-hover-button-green)"
                                    text="1" />
                                <SimpleButton
                                    class="border border-(--button-green) rounded py-4 bg-(--calc-button-green) hover:bg-(--calc-hover-button-green)"
                                    text="2" />
                                <SimpleButton
                                    class="border border-(--button-green) rounded py-4 bg-(--calc-button-green) hover:bg-(--calc-hover-button-green)"
                                    text="3" />
                                <SimpleButton
                                    class="border border-(--button-green) rounded py-4 bg-(--calc-button-green) hover:bg-(--calc-hover-button-green)"
                                    text="4" />
                                <SimpleButton
                                    class="border border-(--button-green) rounded py-4 bg-(--calc-button-green) hover:bg-(--calc-hover-button-green)"
                                    text="5" />
                                <SimpleButton
                                    class="border border-(--button-green) rounded py-4 bg-(--calc-button-green) hover:bg-(--calc-hover-button-green)"
                                    text="6" />
                                <SimpleButton
                                    class="border border-(--button-green) rounded py-4 bg-(--calc-button-green) hover:bg-(--calc-hover-button-green)"
                                    text="7" />
                                <SimpleButton
                                    class="border border-(--button-green) rounded py-4 bg-(--calc-button-green) hover:bg-(--calc-hover-button-green)"
                                    text="8" />
                                <SimpleButton
                                    class="border border-(--button-green) rounded py-4 bg-(--calc-button-green) hover:bg-(--calc-hover-button-green)"
                                    text="9" />
                                <SimpleButton
                                    class="border border-(--button-green) rounded py-4 bg-(--calc-button-green) hover:bg-(--calc-hover-button-green)"
                                    text="⌫" />
                                <SimpleButton
                                    class="border border-(--button-green) rounded py-4 bg-(--calc-button-green) hover:bg-(--calc-hover-button-green)"
                                    text="0" />
                                <SimpleButton
                                    class="border border-(--button-green) rounded py-4 bg-(--calc-button-green) hover:bg-(--calc-hover-button-green)"
                                    text="C" />
                                <SimpleButton
                                    class="col-span-3 text-lg font-bold py-3 border border-(--button-green) rounded py-4 bg-(--calc-button-green) hover:bg-(--calc-hover-button-green)"
                                    text="Confirm Payment" />
                            </div>
                        </div>

                    </div>
                </div>
            </template>


        </ModalTemplate>
    </Teleport>
</template>