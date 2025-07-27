<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Getting Started with Vue.js 3',
                'content' => 'Vue.js is a progressive framework for building user interfaces. This guide will walk you through the basics of creating your first Vue application, from setting up your environment to rendering your first component.',
                'status' => 'published',
                'image' => 'https://picsum.photos/seed/vuejs/1200/800',
                'user_id' => 1,
            ],
            [
                'title' => 'The Power of Pinia for State Management',
                'content' => 'Pinia is the new official state management library for Vue. It offers a simpler API compared to Vuex, with full TypeScript support and a more intuitive structure. Let\'s explore how to integrate Pinia into your project.',
                'status' => 'published',
                'image' => 'https://picsum.photos/seed/pinia/1200/800',
                'user_id' => 1,
            ],
            [
                'title' => 'Mastering Tailwind CSS for Rapid UI Development',
                'content' => 'Tailwind CSS is a utility-first CSS framework that allows you to build custom designs without ever leaving your HTML. It provides low-level utility classes that let you build beautiful, responsive layouts quickly.',
                'status' => 'published',
                'image' => null,
                'user_id' => 1,
            ],
            [
                'title' => 'Understanding Laravel Eloquent ORM',
                'content' => 'Eloquent is Laravel\'s powerful Object-Relational Mapper (ORM). It makes interacting with your database a breeze by allowing you to work with your database tables as if they were objects. This post covers the fundamentals.',
                'status' => 'draft',
                'image' => 'https://picsum.photos/seed/laravel/1200/800',
                'user_id' => 1,
            ],
            [
                'title' => 'Building a RESTful API with Laravel',
                'content' => 'This is a draft for a future post on building a complete RESTful API. Topics to cover include routing, controllers, resource controllers, and API authentication with Sanctum.',
                'status' => 'draft',
                'image' => null,
                'user_id' => 1,
            ],
            [
                'title' => 'Deploying a Vue and Laravel App',
                'content' => 'Learn how to deploy a modern web application built with Laravel as the backend and Vue.js as the frontend. We will cover steps for compiling assets and configuring a production server.',
                'status' => 'published',
                'image' => 'https://picsum.photos/seed/deploy/1200/800',
                'user_id' => 1,
            ],
        ];

        foreach ($posts as $postData) {
            Post::create($postData);
        }
    }
}
