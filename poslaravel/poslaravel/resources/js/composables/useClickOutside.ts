// useClickOutside.ts

/**
 * Handles a click outside of a document to close a modal, popover, etc 
 */
import { onMounted, onUnmounted, Ref } from 'vue'

export function useClickOutside(element: Ref<HTMLElement | null>, callback: () => void) {
    const handler = (e: MouseEvent) => {
        if (element.value && !element.value.contains(e.target as Node)) {
            callback();
        }
    };

    onMounted(() => document.addEventListener('mousedown', handler));
    onUnmounted(() => document.removeEventListener('mousedown', handler));
}
