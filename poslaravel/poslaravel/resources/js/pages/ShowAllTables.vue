<script setup lang="ts">
import AppHeader from '@/components/AppHeader.vue';
import TableCard from '@/components/ui/customer-table/TableCard.vue';
import CopyrightFooter from '@/components/ui/footer/CopyrightFooter.vue';

// Possible statuses
const statuses = ['occupied', 'free', 'billPrinted'];

// Create tables with random status
const tables = Array.from({ length: 80 }, (_, i) => ({
    id: i + 1,
    number: i + 1,
    bill: Math.random() * 500 + 100,
    status: statuses[Math.floor(Math.random() * statuses.length)]
}));
</script>

<template>
    <div class="flex flex-col h-screen">
        <div class="sticky top-0 z-10 bg-white shadow">
            <AppHeader />
        </div>

        <div class="flex-1 overflow-y-auto p-4">
            <div class="flex-grow grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 gap-4">
                <TableCard 
                    v-for="table in tables" 
                    :key="table.id" 
                    :tableNumber="table.number" 
                    :billAmount="table.bill"
                    :status="table.status" />
            </div>
        </div>

        <div>
            <CopyrightFooter />
        </div>
    </div>
</template>
