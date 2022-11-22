<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            [
                'title' => '10 CMS Features that Make Your Content Marketing',
                'content' => 'Typically, enterprise-level organizations have a large team from across various departments involved in content creation and publishing.

An enterprise-grade CMS like Varbase features a content publishing and management workflow that supports the requirements of enterprise-level content marketing strategies. The CMS will enable your team to track and monitor the content creation process,  from authoring, editing, and approval to publication, promotion, and reporting, in a seamless manner.

Moderating the content creation process will be a critical asset for larger enterprises that rely upon content-heavy marketing communications.',
                'image_url' => 'https://blog.iqbalhasan.dev/wp-content/uploads/2022/08/Top-10-CMS-Software-740x414.png',
            ],
            [
                'title' => 'Laravel Telescope',
                'content' => 'Laravel Telescope makes a wonderful companion to your local Laravel development environment. Telescope provides insight into the requests coming into your application, exceptions, log entries, database queries, queued jobs, mail, notifications, cache operations, scheduled tasks, variable dumps, and more.',
                'image_url' => 'https://blog.iqbalhasan.dev/wp-content/uploads/2022/08/Laravel-Telescope-740x414.png',
            ],
            [
                'title' => 'Laravel Excel',
                'content' => 'Laravel Excel has extensive documentation showing you the basics to simplify the imports and exports in your application. Let Laravel Excel do the heavy lifting for you! It is a breeze to get started with Laravel Excel.',
                'image_url' => 'https://blog.iqbalhasan.dev/wp-content/uploads/2022/08/Larvel-Excel-740x414.png',
            ],
            [
                'title' => 'Laravel Jetstream is a beautifully designed Authenticator starter kit',
                'content' => 'Laravel Jetstream is a beautifully designed application starter kit for Laravel and provides the perfect starting point for your next Laravel application. Jetstream provides the implementation for your application\'s login, registration, email verification, two-factor authentication, session management, API via Laravel Sanctum, and optional team management features.

Jetstream is designed using Tailwind CSS and offers your choice of Livewire or Inertia scaffolding.',
                'image_url' => 'https://blog.iqbalhasan.dev/wp-content/uploads/2022/08/Laravel-Jetstream-740x414.png',
            ],
        ];


        // insert data into the posts table
        Post::insert($posts);
    }
}
