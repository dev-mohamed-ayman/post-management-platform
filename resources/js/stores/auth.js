import {defineStore} from "pinia";
import axios from "axios";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        user: null,
        token: null,
        role: null,
    }),
    getters: {
        getToken() {
            return this.token || localStorage.getItem("token");
        },
        getRole() {
            return this.role || localStorage.getItem("role");
        }
    },
    actions: {
        loginPath(role) {
            return role === 'admin' ? 'admin/login' : 'user/login';
        },

        async login(form, role) {
            const {data} = await axios.post(this.loginPath(role), form)
            this.token = data.data.token;
            this.role = role;
            localStorage.setItem("token", data.data.token);
            localStorage.setItem("role", role);
            await this.fetchUser();
        },
        async fetchUser() {
            const {data} = await axios.get("profile");
            this.user = data.data.user;
            this.role = data.data.role;
            localStorage.setItem("role", data.data.role)
        },
        async logout() {
            try {
                await axios.post("logout");
            } catch (e) {

            } finally {
                this.user = null;
                this.role = null;
                this.token = null;
                localStorage.removeItem("token");
                localStorage.removeItem("role");
            }
        },
        async init() {
            this.token = localStorage.getItem("token");
            this.role = localStorage.getItem("role");
            if (this.token && this.role && !this.user) {
                try {
                    await this.fetchUser();
                } catch {
                    await this.logout();
                }
            }
        },
    }
});
