<script setup>
import {Shield, UserCircle, Mail, Lock, AlertCircle} from 'lucide-vue-next'
import {useAuthStore} from "../stores/auth.js";
import {ref} from "vue";
import * as yup from 'yup';
import {useField, useForm} from "vee-validate";
import router from "@/router/index.js";

const props = defineProps({
    role: {
        type: String,
        required: true
    }
})

const auth = useAuthStore();
const errorMessage = ref(null);

const schema = yup.object({
    email: yup.string().required().email(),
    password: yup.string().required().min(6),
});

const {handleSubmit, setErrors} = useForm({
    validationSchema: schema
});

const {value: email, errorMessage: emailError} = useField('email');
const {value: password, errorMessage: passwordError, resetField: resetPasswordField,} = useField('password');

const login = handleSubmit(async (values) => {
    try {
        errorMessage.value = null;

        await auth.login(values, props.role);
        router.push({name: props.role === 'admin' ? 'AdminDashboard' : 'userDashboard'});

    } catch (error) {
        console.log(error)
        if (!error.response || !error.response.data) {
            errorMessage.value = "Unexpected error occurred";
            return;
        }

        const errors = error.response.data.errors;

        if (!errors || typeof errors === 'string') {
            errorMessage.value = errors || error.response.data.message || "Login failed";
        } else if (typeof errors === 'object') {
            const formatedErrors = {};
            Object.keys(errors).forEach((field) => {
                formatedErrors[field] = errors[field][0];
            });
            setErrors(formatedErrors);
        }
    }
});

</script>

<template>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-50 to-slate-100">
        <div class="max-w-md w-full mx-4">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <!-- Header -->
                <div :class="['px-8 py-6', role === 'admin' ? 'bg-blue-50' : 'bg-emerald-50']">
                    <div class="flex items-center justify-center mb-4">
                        <div :class="['p-3 rounded-full', role === 'admin' ? 'bg-blue-100' : 'bg-emerald-100']">
                            <Shield v-if="role === 'admin'" class="h-8 w-8 text-blue-600"/>
                            <UserCircle v-else class="h-8 w-8 text-emerald-600"/>
                        </div>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 text-center">
                        {{ role === 'admin' ? 'Admin Login' : 'User Login' }}
                    </h2>
                    <p class="text-gray-600 text-center mt-2">
                        {{ role === 'admin' ? 'Access the admin dashboard' : 'Sign in to manage your posts' }}
                    </p>
                </div>

                <!-- Form -->
                <div class="px-8 py-6">
                    <div class="px-8 py-6">
                        <form @submit.prevent="login" class="space-y-6">
                            <div v-if="errorMessage"
                                 class="flex items-center space-x-2 text-red-600 bg-red-50 px-4 py-3 rounded-lg">
                                <AlertCircle class="h-4 w-4"/>
                                <span class="text-sm">{{ errorMessage }}</span>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email Address
                                </label>
                                <div class="relative">
                                    <Mail
                                        class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400"/>
                                    <input
                                        v-model="email"
                                        id="email"
                                        type="email"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                        placeholder="Enter your email"
                                    />
                                </div>
                                <span v-if="emailError" class="text-sm text-red-600 mt-1 block">{{ emailError }}</span>
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                    Password
                                </label>
                                <div class="relative">
                                    <Lock
                                        class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400"/>
                                    <input
                                        v-model="password"
                                        id="password"
                                        type="password"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2
                                    focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                        placeholder="Enter your password"
                                    />
                                </div>
                                <span v-if="passwordError" class="text-sm text-red-600 mt-1 block">{{
                                        passwordError
                                    }}</span>
                            </div>
                            <button
                                type="submit"
                                :class="[
                                  'w-full py-3 px-4 rounded-lg font-medium transition-all duration-200 flex items-center justify-center space-x-2',
                                  role === 'admin'
                                    ? 'bg-blue-600 hover:bg-blue-700 text-white'
                                    : 'bg-emerald-600 hover:bg-emerald-700 text-white'
                                ]"
                            >
                                <span>Sign In</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
