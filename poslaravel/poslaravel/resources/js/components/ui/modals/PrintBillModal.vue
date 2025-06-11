<script setup lang="ts">
import SimpleButton from '../buttons/SimpleButton.vue';
import ReportViewer from '../reports/ReportViewer.vue';
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
                <ModalHeaderTemplate title="Print Bill" description="Print order for bill" />
            </template>

            <template #body>
                <div class="flex flex-col border border-gray-200 rounded h-[500px]">
                    <div class="overflow-y-auto h-full px-4 py-2 bg-white">
                        <!-- Header -->
                        <div class="text-center mb-4">
                            <h2 class="text-xl font-bold text-gray-800">UPME WORKS</h2>
                            <p class="text-sm text-gray-600">123 Restaurant Street</p>
                            <p class="text-sm text-gray-600">Phone: (123) 456-7890</p>
                            <p class="text-sm text-gray-600">Date: {{ new Date().toLocaleDateString() }}</p>
                            <p class="text-sm text-gray-600">Receipt #: {{ Math.floor(Math.random() * 1000000) }}</p>
                        </div>

                        <!-- Items List -->
                        <div class="border-t border-b border-gray-200 py-2">
                            <div class="grid grid-cols-12 text-sm font-semibold text-gray-600 mb-2">
                                <div class="col-span-6">Item</div>
                                <div class="col-span-2 text-right">Qty</div>
                                <div class="col-span-2 text-right">Price</div>
                                <div class="col-span-2 text-right">Total</div>
                            </div>
                            
                            <!-- Sample Items -->
                            <div v-for="i in 15" :key="i" class="grid grid-cols-12 text-sm py-1">
                                <div class="col-span-6">Sample Item {{ i }}</div>
                                <div class="col-span-2 text-right">{{ Math.floor(Math.random() * 5) + 1 }}</div>
                                <div class="col-span-2 text-right">₱{{ (Math.random() * 1000).toFixed(2) }}</div>
                                <div class="col-span-2 text-right">₱{{ (Math.random() * 5000).toFixed(2) }}</div>
                            </div>
                        </div>

                        <!-- Totals -->
                        <div class="mt-4 space-y-2">
                            <div class="flex justify-between text-sm">
                                <span>Subtotal:</span>
                                <span>₱{{ (Math.random() * 10000).toFixed(2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span>Service Charge (10%):</span>
                                <span>₱{{ (Math.random() * 1000).toFixed(2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span>Tax (12%):</span>
                                <span>₱{{ (Math.random() * 1200).toFixed(2) }}</span>
                            </div>
                            <div class="flex justify-between font-bold text-lg border-t border-gray-200 pt-2">
                                <span>Total:</span>
                                <span>₱{{ (Math.random() * 15000).toFixed(2) }}</span>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="mt-8 text-center text-sm text-gray-600">
                            <p>Thank you for dining with us!</p>
                            <p class="mt-2">Please come again</p>
                        </div>
                    </div>
                </div>
            </template>

            <template #footer>
                <div class="flex justify-between gap-2 px-4 pb-6 items-center">
                    <SimpleButton
                        class="w-full bg-(--button-green) text-white py-2 rounded hover:bg-(--selected-button-green)"
                        text="Print" />
                </div>
            </template>
        </ModalTemplate>
    </Teleport>
</template>