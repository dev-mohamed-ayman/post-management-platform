<script setup>
import {ref, computed} from 'vue'
import {Shield, UserCircle, User, LogOut} from 'lucide-vue-next'
import {useAuthStore} from "../../stores/auth.js";
import router from "@/router/index.js";

const auth = useAuthStore();

const role = computed(() => auth.getRole);
const user = computed(() => auth.user);

const handleLogout = async () => {
    await auth.logout();
    router.push({name: 'Home'})
}
</script>

<template>
    <header
        :class="[
      'shadow-sm border-b',
      role === 'admin'
        ? 'bg-white border-blue-200'
        : 'bg-white border-emerald-200'
    ]"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="flex flex-col sm:flex-row justify-between items-start sm:items-center py-4 sm:h-16 gap-4 sm:gap-0">
                <!-- Left Side -->
                <div class="flex items-center space-x-3">
                    <div
                        :class="[
              'p-2 rounded-lg',
              role === 'admin' ? 'bg-blue-100' : 'bg-emerald-100'
            ]"
                    >
                        <Shield
                            v-if="role === 'admin'"
                            class="h-5 w-5 sm:h-6 sm:w-6 text-blue-600"
                        />
                        <UserCircle
                            v-else
                            class="h-5 w-5 sm:h-6 sm:w-6 text-emerald-600"
                        />
                    </div>
                    <div>
                        <h1 class="text-base sm:text-lg font-semibold text-gray-900">
                            {{ role === 'admin' ? 'Admin Dashboard' : 'My Posts' }}
                        </h1>
                        <p class="text-xs text-gray-500">Welcome back, {{ user.name }}</p>
                    </div>
                </div>

                <!-- Right Side -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 sm:gap-4">
                    <div class="flex items-center space-x-2 text-sm">
                        <User class="h-4 w-4 text-gray-500"/>
                        <span class="text-gray-700 text-xs sm:text-sm">{{ user.email }}</span>
                        <span
                            :class="[
                'px-2 py-1 rounded-full text-xs font-medium',
                role === 'admin'
                  ? 'bg-blue-100 text-blue-800'
                  : 'bg-emerald-100 text-emerald-800'
              ]"
                        >
              {{ role }}
            </span>
                    </div>

                    <button
                        style="cursor: pointer"
                        @click="handleLogout"
                        :class="[
              'flex items-center space-x-2 px-3 py-2 text-xs sm:text-sm text-gray-700 hover:text-gray-900 rounded-md transition-colors duration-200',
              auth.role === 'admin'
                ? 'hover:bg-blue-50'
                : 'hover:bg-emerald-50'
            ]"
                    >
                        <LogOut class="h-4 w-4"/>
                        <span>Logout</span>
                    </button>
                </div>
            </div>
        </div>
    </header>
</template>


<style scoped>

</style>
