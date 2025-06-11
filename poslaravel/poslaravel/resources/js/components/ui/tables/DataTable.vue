<script setup lang="ts">
import ButtonIcon from '../buttons/ButtonIcon.vue';

interface Column {
    key: string
    label: string
    width?: string
    align?: 'left' | 'center' | 'right'
}

interface TableData {
    [key: string]: any
}

interface Props {
    columns: Column[]
    data: TableData[]
    showActions?: boolean
    showEdit?: boolean
    showDelete?: boolean
    showSplitBill?: boolean
}

const props = withDefaults(defineProps<Props>(), {
    showActions: false,
    showEdit: false,
    showDelete: false,
    showSplitBill: false
})

const emit = defineEmits<{
    edit: [item: TableData, index: number]
    delete: [item: TableData, index: number]
}>()

const handleEdit = (item: TableData, index: number) => {
    emit('edit', item, index)
}

const handleDelete = (item: TableData, index: number) => {
    emit('delete', item, index)
}

const getAlignClass = (align?: string) => {
    switch (align) {
        case 'center': return 'text-center'
        case 'right': return 'text-right'
        default: return 'text-left'
    }
}
</script>

<template>
    <table class="w-full text-xs border-collapse border outline outline-gray-300 overflow-hidden text-center rounded-lg">
      <thead class="bg-gray-100 text-(--upme-dark-green)">
        <tr>
          <th
            v-for="(column, colIdx) in columns"
            :key="column.key"
            :class="[
              'border border-gray-300 px-4 py-2 whitespace-nowrap',
              getAlignClass(column.align),
              colIdx === 0 ? 'rounded-tl-lg' : '',
              colIdx === columns.length - 1 && !(showEdit || showDelete || showSplitBill) ? 'rounded-tr-lg' : ''
            ]"
            :style="column.width ? { width: column.width } : {}"
          >
            {{ column.label }}
          </th>
  
          <!-- Action headers with borders and rounded corners on last header cell -->
          <th
            v-if="showEdit"
            class="border border-gray-300 px-2 py-2 w-12"
            :class="!showDelete && !showSplitBill ? 'rounded-tr-lg' : ''"
          />
          <th
            v-if="showDelete"
            class="border border-gray-300 px-2 py-2 w-12"
            :class="!showSplitBill ? 'rounded-tr-lg' : ''"
          />
          <th
            v-if="showSplitBill"
            class="border border-gray-300 px-2 py-2 w-12 rounded-tr-lg"
          />
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, rowIdx) in data" :key="rowIdx" class="hover:bg-gray-50">
          <td
            v-for="(column, colIdx) in columns"
            :key="column.key"
            :class="[
              'border border-gray-300 px-4 py-2 text-(--upme-dark-green) whitespace-nowrap',
              getAlignClass(column.align),
              rowIdx === data.length - 1 && colIdx === 0 ? 'rounded-bl-lg' : '',
              rowIdx === data.length - 1 && colIdx === columns.length - 1 && !(showEdit || showDelete || showSplitBill) ? 'rounded-br-lg' : ''
            ]"
          >
            <slot :name="`cell-${column.key}`" :item="item" :value="item[column.key]" :index="rowIdx">
              {{ item[column.key] }}
            </slot>
          </td>
  
          <!-- Optional Action Buttons with borders and rounded corners on last row -->
          <td
            v-if="showActions && showEdit"
            class="border border-gray-300 text-center text-(--upme-dark-green)"
            :class="rowIdx === data.length - 1 && !showDelete && !showSplitBill ? 'rounded-br-lg' : ''"
          >
            <slot name="edit-button" :item="item" :index="rowIdx">
              <ButtonIcon
                icon="fas fa-pencil"
                title="Edit"
                class="text-(--upme-dark-green)"
                @click="handleEdit(item, rowIdx)"
              />
            </slot>
          </td>
          <td
            v-if="showActions && showDelete"
            class="border border-gray-300 text-center"
            :class="rowIdx === data.length - 1 && !showSplitBill ? 'rounded-br-lg' : ''"
          >
            <slot name="delete-button" :item="item" :index="rowIdx">
              <ButtonIcon
                icon="fas fa-trash"
                title="Delete"
                class="text-red-800"
                @click="handleDelete(item, rowIdx)"
              />
            </slot>
          </td>
          <td
            v-if="showSplitBill"
            class="border border-gray-300 text-center"
            :class="rowIdx !== data.length - 1 ? '' : 'rounded-br-lg'"
          >
            <slot name="transfer-button" :item="item" :index="rowIdx">
              <ButtonIcon
                icon="fas fa-share"
                title="Transfer"
                class="text-(--upme-dark-green)"
                @click="handleDelete(item, rowIdx)"
              />
            </slot>
          </td>
        </tr>
      </tbody>
    </table>
  </template>
  