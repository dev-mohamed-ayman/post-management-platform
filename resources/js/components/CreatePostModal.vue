<!-- components/CreatePostModal.vue -->
<script setup>
import {ref, watch} from 'vue';
import {useForm, useField} from 'vee-validate';
import * as yup from 'yup';
import {AlertCircle, FileText, ImageIcon, Type, Layers} from 'lucide-vue-next';

const props = defineProps({
    show: Boolean
});

const emit = defineEmits(['close', 'submit']);

const schema = yup.object({
    title: yup.string().required('Title is required'),
    content: yup.string().required('Content is required'),
    status: yup.string().oneOf(['draft', 'published']).required('Status is required'),
    image: yup.mixed().nullable()
});

const {handleSubmit, resetForm, setFieldValue} = useForm({
    validationSchema: schema
});

const {value: title, errorMessage: titleError} = useField('title');
const {value: content, errorMessage: contentError} = useField('content');
const {value: status, errorMessage: statusError} = useField('status');
const {value: image, errorMessage: imageError} = useField('image');

const onSubmit = handleSubmit((values) => {
    emit('submit', values);
    resetForm();
    emit('close');
});

watch(() => props.show, (value) => {
    if (!value) resetForm();
});
</script>

<template>
    <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 bg-opacity-50">
        <div class="bg-white w-full max-w-lg rounded-xl shadow-lg p-6 relative">
            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800">Create New Post</h2>
                <button @click="$emit('close')" class="text-gray-400 hover:text-gray-600 text-3xl" style="cursor: pointer">&times;</button>
            </div>

            <!-- Form -->
            <form @submit.prevent="onSubmit" class="space-y-5">
                <!-- Title -->
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Title</label>
                    <div class="relative">
                        <Type class="absolute left-3 top-3.5 h-4 w-4 text-gray-400"/>
                        <input
                            v-model="title"
                            type="text"
                            placeholder="Post title"
                            class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                        />
                    </div>
                    <p v-if="titleError" class="text-sm text-red-600 mt-1">{{ titleError }}</p>
                </div>

                <!-- Content -->
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Content</label>
                    <textarea
                        v-model="content"
                        rows="4"
                        placeholder="Post content..."
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    ></textarea>
                    <p v-if="contentError" class="text-sm text-red-600 mt-1">{{ contentError }}</p>
                </div>

                <!-- Status -->
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Status</label>
                    <div class="relative">
                        <Layers class="absolute left-3 top-3.5 h-4 w-4 text-gray-400"/>
                        <select
                            v-model="status"
                            class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                        >
                            <option value="">Select status</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                    <p v-if="statusError" class="text-sm text-red-600 mt-1">{{ statusError }}</p>
                </div>

                <!-- Image -->
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Image (optional)</label>
                    <div class="relative">
                        <ImageIcon class="absolute left-3 top-3.5 h-4 w-4 text-gray-400"/>
                        <input
                            type="file"
                            class="pl-10 pr-4 py-2 w-full border rounded-lg"
                            @change="(e) => setFieldValue('image', e.target.files[0])"
                        />
                    </div>
                    <p v-if="imageError" class="text-sm text-red-600 mt-1">{{ imageError }}</p>
                </div>

                <!-- Actions -->
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" @click="$emit('close')"
                            class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-700">Cancel
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
