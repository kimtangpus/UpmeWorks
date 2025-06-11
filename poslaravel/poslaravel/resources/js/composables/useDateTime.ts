import { onBeforeUnmount, onMounted, ref } from 'vue';

export function useDateTime() {
    const currentDate = ref('');
    const currentTime = ref('');

    function updateDateTime() {
        const now = new Date();

        currentDate.value = now.toLocaleDateString('en-US', {
            weekday: 'short',
            month: 'short',
            day: 'numeric',
        });

        currentTime.value = now.toLocaleTimeString('en-US', {
            hour: 'numeric',
            minute: '2-digit',
            hour12: true,
        });
    }

    onMounted(() => {
        updateDateTime();
        const interval = setInterval(updateDateTime, 1000);
        onBeforeUnmount(() => clearInterval(interval));
    });

    return {
        currentDate,
        currentTime,
    };
}
