<script setup lang="ts">
import ButtonIcon from '../buttons/ButtonIcon.vue';
import SimpleButton from '../buttons/SimpleButton.vue';
import ReportViewer from '../reports/ReportViewer.vue';
import ModalHeaderTemplate from './modal-templates/ModalHeaderTemplate.vue';
import ModalTemplate from './modal-templates/ModalTemplate.vue';

const props = defineProps({
    show: Boolean,
    title: {
        type: String,
        required: true
    }
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
        <ModalHeaderTemplate :title="title" @close="handleClose" />
      </template>

      <template #body>
        <div class="flex flex-col gap-4 px-6 py-4 w-[1500px] h-[500px]">
          <div class="flex items-center gap-6 text-(--upme-dark-green)">
            <div class="flex items-center gap-2">
              <label class="font-semibold whitespace-nowrap">Date Range:</label>

              <input type="date" class="border rounded px-3 py-1" />

              <span class="mx-1 text-gray-500">–</span>

              <input type="date" class="border rounded px-3 py-1" />
            </div>
            
            <div class="flex items-center gap-2">
              <ButtonIcon title="Preview" icon="fas fa-window-restore" class="text-lg" />
              <ButtonIcon title="Refresh" icon="fas fa-arrows-rotate" class="text-lg" />
            </div>
          </div>


          <!-- Report Viewer -->
          <ReportViewer />
        </div>
      </template>

    </ModalTemplate>
  </Teleport>
</template>