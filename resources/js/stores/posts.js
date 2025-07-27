import {defineStore} from "pinia";

export const usePostsStore = defineStore('posts', {
    state: () => ({
        posts: null
    }),
    actions: {
        async createPost(form) {
            await axios.post('posts', form, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
            this.fetchPosts();
        },
        async updatePost(form) {
            await axios.post(`posts/${form.id}`, form, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
            this.fetchPosts();
        },
        async deletePost(id, form) {
            await axios.delete(`posts/${id}`);
            this.fetchPosts();
        },
        async fetchPosts() {
            const response = await axios.get('posts');
            this.posts = response.data.data.posts;
        },
    }
})
