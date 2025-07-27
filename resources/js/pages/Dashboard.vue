<script setup>
import {Shield, Plus, FileText, Eye, EyeOff, Users, Search, Filter} from 'lucide-vue-next';
import {computed, reactive, ref, onMounted} from 'vue'
import {useAuthStore} from "../stores/auth.js";
import {usePostsStore} from "../stores/posts.js";
import CreatePostModal from "@/components/CreatePostModal.vue";
import ConfirmDeleteModal from "@/components/ConfirmDeleteModal.vue";
import EditPostModal from "@/components/EditPostModal.vue";

onMounted(() => {
    postsStore.fetchPosts();
});

const auth = useAuthStore();
const postsStore = usePostsStore();
const showModal = ref(false);
const showDeleteModal = ref(false);
const postToDelete = ref(null);
const showEditModal = ref(false);
const postToEdit = ref(null);

const handlePostUpdate = async (updatedPost) => {
    await postsStore.updatePost(updatedPost);
    showEditModal.value = false;
    postToEdit.value = null;
};

const role = computed(() => auth.getRole);

const stats = reactive({
    total: 120,
    published: 80,
    draft: 30,
    authors: 10,
})
const handlePostSubmit = async (data) => {
    await postsStore.createPost(data)
    showModal.value = false;
};
const confirmDeletePost = async () => {
    await postsStore.deletePost(postToDelete.value.id);
    showDeleteModal.value = false;
    postToDelete.value = null;
};

</script>

<template>
    <div
        :class="['min-h-screen', role=== 'admin' ? 'bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50' : 'bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50']">
        <CreatePostModal :show="showModal" @close="showModal = false" @submit="handlePostSubmit"/>
        <ConfirmDeleteModal
            :show="showDeleteModal"
            :title="postToDelete?.title"
            @confirm="confirmDeletePost"
            @cancel="showDeleteModal = false"
        />
        <EditPostModal
            :show="showEditModal"
            :post="postToEdit"
            @close="showEditModal = false"
            @update="handlePostUpdate"
        />
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Admin Header -->
            <div class="mb-8">
                <div class="bg-white rounded-2xl shadow-sm border border-blue-100 p-6 md:p-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <!-- Left Side -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-3 sm:space-y-0">
                            <div
                                class="p-3 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl shadow-lg self-start sm:self-auto">
                                <Shield class="h-8 w-8 text-white"/>
                            </div>
                            <div>
                                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">
                                    Admin Dashboard
                                </h1>
                                <p class="text-gray-600 mt-1 text-sm md:text-base">
                                    Manage all posts and oversee platform activity
                                </p>
                            </div>
                        </div>

                        <!-- Right Side -->
                        <button
                            @click="showModal = true"
                            style="cursor: pointer"
                            class="w-full sm:w-auto flex items-center justify-center space-x-2 px-4 py-2 md:px-6 md:py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl font-semibold transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1"
                        >
                            <Plus class="h-5 w-5"/>
                            <span>Create Post</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Enhanced Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-200"
                >
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <FileText class="h-6 w-6 text-blue-600"/>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Posts</p>
                            <p class="text-3xl font-bold text-gray-900">{{ stats.total }}</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-200"
                >
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-emerald-100 rounded-lg">
                            <Eye class="h-6 w-6 text-emerald-600"/>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Published</p>
                            <p class="text-3xl font-bold text-gray-900">{{ stats.published }}</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-200"
                >
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-amber-100 rounded-lg">
                            <EyeOff class="h-6 w-6 text-amber-600"/>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Drafts</p>
                            <p class="text-3xl font-bold text-gray-900">{{ stats.draft }}</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-200"
                >
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-purple-100 rounded-lg">
                            <Users class="h-6 w-6 text-purple-600"/>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Authors</p>
                            <p class="text-3xl font-bold text-gray-900">{{ stats.authors }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 sm:p-6 mb-6 sm:mb-8">
                <div class="flex flex-col lg:flex-row gap-4">

                    <!-- Search input -->
                    <div class="flex-1 relative">
                        <Search class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400"/>
                        <input
                            type="text"
                            placeholder="Search posts by title, content, or author..."
                            class="w-full pl-10 pr-4 py-2.5 sm:py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        />
                    </div>

                    <!-- Filter dropdown -->
                    <div class="flex items-center space-x-2">
                        <Filter class="h-5 w-5 text-gray-500"/>
                        <select
                            class="px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white"
                        >
                            <option value="all">All Status</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>

                </div>
            </div>


            <!-- Post Card -->
            <div v-if="Array.isArray(postsStore.posts) && postsStore.posts.length > 0"
                 class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
                <div
                    v-for="post in postsStore.posts"
                    :key="post.id"
                    class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-lg hover:border-gray-300 transition-all duration-200 overflow-hidden transform hover:-translate-y-1"
                >
                    <img
                        v-if="post.image"
                        :src="post.image"
                        alt="Post Image"
                        class="w-full h-48 object-cover"
                    />
                    <div v-else class="w-full h-48 bg-slate-100 flex items-center justify-center">
                        <FileText class="h-16 w-16 text-slate-300"/>
                    </div>
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 leading-tight">
                                    {{ post.title }}
                                </h3>
                                <div class="flex items-center space-x-4 text-sm text-gray-500 mb-3">
                                    <div v-if="post.user" class="flex items-center space-x-1">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span>{{ post.user?.name ?? 'Unknown' }}</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M8 7V3m8 4V3m-9 8h10m-13 4h16m-16 4h16M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ new Date(post.created_at).toLocaleDateString() }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2 ml-4">
      <span
          class="px-3 py-1 rounded-full text-sm font-medium"
          :class="{
          'bg-emerald-100 text-emerald-800': post.status === 'published',
          'bg-amber-100 text-amber-800': post.status === 'draft'
        }"
      >
        {{ post.status }}
      </span>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed">
                            {{ post.content }}
                        </p>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center space-x-1 text-sm text-gray-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15 12a3 3 0 01-6 0m9-4a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Last updated {{ new Date(post.created_at).toLocaleDateString() }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button
                                    class="text-blue-600 hover:text-blue-800 hover:bg-blue-50 px-3 py-2 text-sm font-medium rounded-lg"
                                    @click="() => { showEditModal = true; postToEdit = post }">
                                    Edit
                                </button>
                                <button
                                    class="text-red-600 hover:text-red-800 hover:bg-red-50 px-3 py-2 text-sm font-medium rounded-lg"
                                    @click="() => { showDeleteModal = true; postToDelete = post }">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Empty State -->
            <div v-else class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
                <div class="max-w-md mx-auto">
                    <div class="p-4 bg-blue-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                        <svg class="h-10 w-10 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16h16M4 8h16M4 12h16"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No posts found</h3>
                    <p class="text-gray-600 mb-6">
                        Try adjusting your search or filter criteria
                    </p>
                    <button
                        @click="showModal = true"
                        class="inline-flex items-center space-x-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl font-semibold transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1"
                    >
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Create First Post</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
