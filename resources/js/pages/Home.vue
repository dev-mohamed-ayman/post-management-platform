<script setup>
import {FileText, Shield, UserCircle, Users, Zap, Lock} from 'lucide-vue-next';
</script>
<template>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
        <!-- Header -->
        <header class="relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="text-center">
                    <div class="flex justify-center mb-6">
                        <div class="p-3 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl shadow-lg">
                            <FileText class="h-12 w-12 text-white"/>
                        </div>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
                        Post Management
                        <span class="block text-blue-600">Platform</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto leading-relaxed">
                        A powerful platform for managing posts with role-based access control.
                        Administrators can oversee all content while users manage their personal posts.
                    </p>

                    <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                        <RouterLink :to="{name:'AdminLogin'}"
                            class="flex items-center justify-center space-x-2 px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1"
                            style="cursor: pointer"
                        >
                            <Shield class="h-5 w-5"/>
                            <span>Admin Login</span>
                        </RouterLink>
                        <RouterLink :to="{name:'UserLogin'}"
                            class="flex items-center justify-center space-x-2 px-8 py-4 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-semibold transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1"
                            style="cursor: pointer"
                        >
                            <UserCircle class="h-5 w-5"/>
                            <span>User Login</span>
                        </RouterLink>
                    </div>
                </div>
            </div>
        </header>

        <!-- Features -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">
                        Powerful Features for Everyone
                    </h2>
                    <p class="text-xl text-gray-600">
                        Built with modern web technologies and user experience in mind
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div
                        class="text-center p-6 rounded-xl border border-gray-200 hover:border-blue-300 hover:shadow-lg transition-all duration-200">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <Shield class="h-6 w-6 text-blue-600"/>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Admin Control</h3>
                        <p class="text-gray-600">
                            Full administrative access to manage all posts, users, and platform settings
                        </p>
                    </div>

                    <div
                        class="text-center p-6 rounded-xl border border-gray-200 hover:border-emerald-300 hover:shadow-lg transition-all duration-200">
                        <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <Users className="h-6 w-6 text-emerald-600"/>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">User Management</h3>
                        <p class="text-gray-600">
                            Personal dashboard for users to create, edit, and manage their own posts
                        </p>
                    </div>

                    <div
                        class="text-center p-6 rounded-xl border border-gray-200 hover:border-indigo-300 hover:shadow-lg transition-all duration-200">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <Zap class="h-6 w-6 text-indigo-600"/>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Fast & Responsive</h3>
                        <p class="text-gray-600">
                            Built with modern React and optimized for performance across all devices
                        </p>
                    </div>

                    <div
                        class="text-center p-6 rounded-xl border border-gray-200 hover:border-purple-300 hover:shadow-lg transition-all duration-200">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <Lock className="h-6 w-6 text-purple-600"/>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Secure Access</h3>
                        <p class="text-gray-600">
                            Role-based authentication ensures users only access their authorized content
                        </p>
                    </div>

                    <div
                        class="text-center p-6 rounded-xl border border-gray-200 hover:border-pink-300 hover:shadow-lg transition-all duration-200">
                        <div class="w-12 h-12 bg-pink-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <FileText class="h-6 w-6 text-pink-600"/>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Post Management</h3>
                        <p class="text-gray-600">
                            Create, edit, and publish posts with draft/published status management
                        </p>
                    </div>

                    <div
                        class="text-center p-6 rounded-xl border border-gray-200 hover:border-cyan-300 hover:shadow-lg transition-all duration-200">
                        <div class="w-12 h-12 bg-cyan-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <UserCircle className="h-6 w-6 text-cyan-600"/>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">User Experience</h3>
                        <p class="text-gray-600">
                            Intuitive interface designed for both technical and non-technical users
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="py-16 bg-gradient-to-r from-blue-600 to-indigo-600">
            <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-white mb-4">Ready to Get Started?</h2>
                <p class="text-xl text-blue-100 mb-8">
                    Choose your role and start managing posts today
                </p>

                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 mb-8">
                    <h3 class="text-lg font-semibold text-white mb-4">Demo Credentials</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div class="bg-white/20 rounded-lg p-4">
                            <p class="font-semibold text-white mb-2">Admin Access</p>
                            <p class="text-blue-100">Email: admin@demo.com</p>
                            <p class="text-blue-100">Password: demo123</p>
                        </div>
                        <div class="bg-white/20 rounded-lg p-4">
                            <p class="font-semibold text-white mb-2">User Access</p>
                            <p class="text-blue-100">Email: user@demo.com</p>
                            <p class="text-blue-100">Password: demo123</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <RouterLink :to="{name:'AdminLogin'}"
                        class="flex items-center justify-center space-x-2 px-8 py-4 bg-white text-blue-600 hover:bg-gray-50 rounded-xl font-semibold transition-all duration-200 shadow-lg hover:-translate-y-1"
                        style="cursor: pointer"
                    >
                        <Shield class="h-5 w-5"/>
                        <span>Try Admin Demo</span>
                    </RouterLink>
                    <RouterLink :to="{name:'UserLogin'}"
                        class="flex items-center justify-center space-x-2 px-8 py-4 bg-white text-emerald-600 hover:bg-gray-50 rounded-xl font-semibold transition-all duration-200 shadow-lg hover:-translate-y-1"
                        style="cursor: pointer"
                    >
                        <UserCircle class="h-5 w-5"/>
                        <span>Try User Demo</span>
                    </RouterLink>
                </div>
            </div>
        </section>
    </div>
</template>
