<script setup>
import {onMounted, onBeforeUnmount, ref, watch} from 'vue';

const props = defineProps({
    show: Boolean,
    title: String
});
const emit = defineEmits(['confirm', 'cancel']);

const modalRef = ref(null);

// Optional: close on outside click
const handleClickOutside = (e) => {
    if (modalRef.value && !modalRef.value.contains(e.target)) {
        emit('cancel');
    }
};

// Optional: close on ESC
const handleKeyDown = (e) => {
    if (e.key === 'Escape') emit('cancel');
};

onMounted(() => {
    document.addEventListener('mousedown', handleClickOutside);
    document.addEventListener('keydown', handleKeyDown);
});
onBeforeUnmount(() => {
    document.removeEventListener('mousedown', handleClickOutside);
    document.removeEventListener('keydown', handleKeyDown);
});
</script>

<template>
    <transition name="fade">
        <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <transition name="scale">
                <div
                    ref="modalRef"
                    class="bg-white rounded-xl shadow-2xl p-6 w-full max-w-sm transition-all"
                >
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Confirm Deletion</h2>
                    <p class="text-gray-600 mb-6">
                        Are you sure you want to delete <strong>{{ title }}</strong>? This action cannot be undone.
                    </p>
                    <div class="flex justify-end space-x-3">
                        <button
                            @click="$emit('cancel')"
                            class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition"
                        >
                            Cancel
                        </button>
                        <button
                            @click="$emit('confirm')"
                            class="px-4 py-2 text-white bg-red-600 hover:bg-red-700 rounded-lg transition"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </transition>
        </div>
    </transition>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.scale-enter-active,
.scale-leave-active {
    transition: all 0.2s ease;
}

.scale-enter-from,
.scale-leave-to {
    transform: scale(0.95);
    opacity: 0;
}
</style>
