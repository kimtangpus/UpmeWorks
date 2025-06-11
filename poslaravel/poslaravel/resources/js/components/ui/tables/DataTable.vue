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
    <table class="w-full border border-gray-200 rounded-xl text-xs">
        <thead class="bg-gray-100 text-(--upme-dark-green)">
            <tr>
                <th v-for="column in columns" :key="column.key" :class="[
                    'border border-gray-300 px-4 py-2 whitespace-nowrap',
                    getAlignClass(column.align),
                    column.key === columns[0].key ? 'rounded-lg' : ''
                ]" :style="column.width ? { width: column.width } : {}">
                    {{ column.label }}
                </th>
                <th v-if="showEdit" class="border border-gray-300 px-2 py-2 w-12" />
                <th v-if="showDelete" class="border border-gray-300 px-2 py-2 w-12" />
                <th v-if="showSplitBill" class="border border-gray-300 px-2 py-2 w-12" />
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item, index) in data" :key="index" class="hover:bg-gray-50">
                <td v-for="column in columns" :key="column.key" :class="[
                    'border border-gray-300 px-4 py-2 text-(--upme-dark-green) whitespace-nowrap',
                    getAlignClass(column.align)
                ]">
                    <slot :name="`cell-${column.key}`" :item="item" :value="item[column.key]" :index="index">
                        {{ item[column.key] }}
                    </slot>
                </td>

                <!-- Optional Action Buttons -->
                <td v-if="showActions && showEdit"
                    class="border border-gray-300 text-center text-(--upme-dark-green)">
                    <slot name="edit-button" :item="item" :index="index">
                        <ButtonIcon icon="fas fa-pencil" title="Edit" class="text-(--upme-dark-green)"
                            @click="handleEdit(item, index)" />
                    </slot>
                </td>
                <td v-if="showActions && showDelete" class="border border-gray-300 text-center">
                    <slot name="delete-button" :item="item" :index="index">
                        <ButtonIcon icon="fas fa-trash" title="Delete" class="text-red-800"
                            @click="handleDelete(item, index)" />
                    </slot>
                </td>
                <td v-if="showSplitBill" class="border border-gray-300 text-center">
                    <slot name="transfer-button" :item="item" :index="index">
                        <ButtonIcon icon="fas fa-share" title="Transfer" class="text-(--upme-dark-green)"
                            @click="handleDelete(item, index)" />
                    </slot>
                </td>
            </tr>
        </tbody>
    </table>
</template>