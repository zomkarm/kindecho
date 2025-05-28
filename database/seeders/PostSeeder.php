<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@kindecho.com')->first();

        if (!$admin) {
            $this->command->error("Admin user not found. Run AdminUserSeeder first.");
            return;
        }

        $moods = ['grateful', 'hopeful', 'inspired', 'peaceful', 'happy'];
        $tags = ['friendship', 'growth', 'career', 'family', 'health', 'learning'];

        for ($i = 0; $i < 50; $i++) {
            Post::create([
                'user_id' => $admin->id,
                'content' => fake()->sentence(10),
                'mood' => fake()->randomElement($moods),
                'tag' => fake()->optional()->randomElement($tags),
            ]);
        }
    }
}
