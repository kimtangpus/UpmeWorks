<script setup lang="ts">
import { usePage } from '@inertiajs/vue3'
import ButtonIcon from './ui/buttons/ButtonIcon.vue';

const page = usePage()

function back() {
  window.history.back()
}

</script>

<template>
  <header class="bg-(--upme-light-green) shadow-sm p-4">
    <div class="flex justify-between items-center">

      <!-- for main POS screen -->
      <div v-if="page.url === '/'" class="flex items-center gap-4 text-(--upme-dark-green)">
        <div>
          <button class="px-4 py-2 bg-(--button-green) text-white rounded-lg hover:bg-[#7ca460] cursor-pointer">
            Add Customer Information
          </button>
        </div>
      </div>

      <!-- for show-orders and transfer-table -->
      <div v-if="page.url === '/show-orders'" class="flex items-center gap-4 text-(--upme-dark-green)">
        <div class="p-2 rounded-lg transition cursor-pointer relative group">
          <ButtonIcon icon="fas fa-chevron-left" title="Back" @click="back" class="hover:bg-gray-100 text-2xl" />
        </div>

        <span class="text-base font-semibold">
          Select Vacant Table
        </span>
      </div>

      <div class="flex items-center gap-4 text-[var(--upme-dark-green)] text-2xl">
        <ButtonIcon icon="fas fa-calculator" title="Calculator" class="hover:bg-gray-100" />

        <ButtonIcon icon="fas fa-sack-dollar" title="Other Charges" class="hover:bg-gray-100" />

        <ButtonIcon icon="fas fa-arrow-right-from-bracket" title="Leave" class="hover:bg-gray-100" />

      </div>

    </div>
  </header>
</template>