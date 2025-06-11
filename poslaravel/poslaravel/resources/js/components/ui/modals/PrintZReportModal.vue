<script setup lang="ts">
import ButtonIcon from '../buttons/ButtonIcon.vue';
import SimpleButton from '../buttons/SimpleButton.vue';
import CardWithInlineTitle from '../cards/CardWithInlineTitle.vue';
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
                <ModalHeaderTemplate title="Z-Reading Report" />
            </template>

            <template #body>
                <ReportViewer />
            </template>

            <template #footer>
                <div class="flex justify-between gap-4 px-12 pb-6 items-center">
                    <SimpleButton
                        class="w-full bg-(--button-green) text-white py-2 rounded hover:bg-(--selected-button-green)"
                        text="Print" />
                </div>
            </template>
        </ModalTemplate>
    </Teleport>
</template>