<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = ['News', 'Finance', 'Business'];

        foreach ($categories as $category) {
            Category::create(['category' => $category]);
        }

        $users = [
            ['name' => 'Janis', 'email' => 'janis@example.com'],
            ['name' => 'Peter', 'email' => 'peter@example.com'],
        ];

        foreach($users as $user) {
            User::factory()->create($user);
        }

        $postsCount = 5;

        for ($i = 0; $i < $postsCount; $i++) {
            $post = Post::factory()->create([
                'user_id' => User::inRandomOrder()->first()->id,
            ]);

            $post->categories()->attach(Category::inRandomOrder()->first()->id);

            $post->refresh();

            $commentsCount = rand(1, 5);

            for ($j = 0; $j < $commentsCount; $j++) {
                $post->comments()->create([
                    'user_id' => User::inRandomOrder()->first()->id,
                    'comment' => fake()->sentence(), // Adjust as needed
                ]);
            }
        }

    }
}
