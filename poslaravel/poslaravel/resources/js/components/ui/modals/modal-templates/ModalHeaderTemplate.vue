<script setup lang="ts">


defineProps({
    title: String,
    description: String,
    icon: String
})

const emit = defineEmits(['close'])

const handleClose = () => {
    emit('close')
}


</script>

<template>
    <div class="flex items-center justify-between p-4 border-b border-gray-200" v-motion
        :initial="{ opacity: 0, y: -20 }" :enter="{ opacity: 1, y: 0, transition: { duration: 300, delay: 100 } }">
        <div class="flex items-center text-(--upme-dark-green) gap-3">
            <i class="text-[24px]" :class="icon"></i>
            <div>
                <h3 class="text-lg font-semibold">
                    {{ title }}
                </h3>
                <p class="text-sm mt-0.5">
                    {{ description }}
                </p>
            </div>
        </div>

        <button type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
            @click="handleClose" v-motion :initial="{ scale: 0.8, opacity: 0 }"
            :enter="{ scale: 1, opacity: 1, transition: { duration: 200, delay: 200 } }" :hover="{ scale: 1.1 }">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
</template>