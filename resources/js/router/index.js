import {createRouter, createWebHistory} from "vue-router";
import Home from "../pages/Home.vue";
import AdminLogin from "../pages/admin/Login.vue";
import UserLogin from "../pages/user/Login.vue";
import AdminLayout from "../components/AdminLayout.vue";
import UserLayout from "../components/UserLayout.vue";
import {useAuthStore} from "../stores/auth.js";
import Dashboard from "../pages/Dashboard.vue";

const routes = [
    {
        path: '/',
        component: Home,
        name: 'Home',
    },
    {
        path: '/admin',
        component: AdminLayout,
        children: [
            {
                path: '',
                name: 'AdminDashboard',
                component: Dashboard,
                meta: {
                    requiresAuth: true,
                    adminOnly: true,
                }
            },
            {
                path: 'login',
                name: 'AdminLogin',
                component: AdminLogin,
                meta: {
                    guestOnly: true,
                }
            }
        ]
    },
    {
        path: '/user',
        component: UserLayout,
        children: [
            {
                path: '',
                name: 'userDashboard',
                component: Dashboard,
                meta: {
                    requiresAuth: true,
                }
            },
            {
                path: 'login',
                component: UserLogin,
                name: 'UserLogin',
                meta: {
                    guestOnly: true,
                }
            }
        ]
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach(async (to, from, next) => {
    const auth = useAuthStore();

    await auth.init();

    if (to.meta.requiresAuth && !auth.user) {
        if (auth.getRole === 'admin') {
            return next("/admin/login");
        } else if (auth.getRole === 'user') {
            return next("/user/login");
        } else {
            return next('/');
        }
    }

    if (to.meta.guestOnly && auth.user) {
        return next(auth.getRole === 'admin' ? "/admin" : "/user");
    }

    if (to.meta.adminOnly && (!auth.user || auth.getRole !== 'admin')) {
        return next("/");
    }

    next();
});

export default router;
