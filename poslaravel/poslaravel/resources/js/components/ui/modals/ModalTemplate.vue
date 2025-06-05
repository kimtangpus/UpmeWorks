<script setup>
import { useMotion } from '@vueuse/motion'

defineProps({
    show: Boolean
})

const emit = defineEmits(['closeModal'])

const { apply: modalMotion } = useMotion()
</script>

<template>
    <Transition name="fade">
        <div v-if="show"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
            @click="emit('closeModal')"
            v-motion
            :initial="{ opacity: 0 }"
            :enter="{ opacity: 1, transition: { duration: 200 } }"
            :leave="{ opacity: 0, transition: { duration: 200 } }">
            <div class="relative w-full max-w-md max-h-[90vh] bg-white rounded-lg shadow-lg" 
                @click.stop
                v-motion
                :initial="{ opacity: 0, y: 20 }"
                :enter="{ opacity: 1, y: 0, transition: { duration: 300, type: 'spring', stiffness: 300 } }"
                :leave="{ opacity: 0, y: 20, transition: { duration: 200 } }">
                <header class="border-none">
                    <slot name="header">Default Header</slot>
                </header>

                <div class="overflow-y-auto">
                    <slot name="body">Default Body</slot>
                </div>

                <footer>
                    <slot name="footer" />
                </footer>
            </div>
        </div>
    </Transition>
</template>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
