<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Str;

class AdminPostsSeeder extends Seeder
{
    public function run(): void
    {
        $moods = ['happy', 'grateful', 'inspired', 'peaceful', 'joyful'];
        $tags = ['life', 'success', 'kindness', 'growth', 'hope', 'learning', 'friendship'];
        $sentiments = ['positive', 'neutral'];

        $sampleContents = [
            'Today, I’m deeply thankful for the small wins that make life beautiful.',
            'Kindness costs nothing, yet means everything. Spread it freely!',
            'Gratitude opens the door to abundance.',
            'The sun always shines after a storm — keep going.',
            'Even the smallest acts of love can create big ripples.',
            'Feeling thankful for the people who lift me up daily.',
            'There’s so much beauty in simplicity.',
            'Learning never ends. Every failure is a lesson in disguise.',
            'Woke up feeling motivated to create something meaningful.',
            'Your smile might be the light someone needs today.',
            'Grateful for another day to try again.',
            'Kindness is a language the deaf can hear and the blind can see.',
            'What you focus on grows — choose gratitude.',
            'One act of kindness can change someone’s entire day.',
            'Be the reason someone believes in good people.',
            'Some days are tough — but I’m tougher.',
            'Growth comes from discomfort. I embrace it.',
            'No gesture of love is ever wasted.',
            'Happiness is homemade.',
            'Progress, not perfection. Always.',
            'I’m proud of how far I’ve come.',
            'Even on bad days, there are things to be thankful for.',
            'I appreciate those who stay and never give up on me.',
            'Positivity breeds resilience.',
            'Every morning is a blank page. Write something worth reading.',
            'You are enough. Don’t forget it.',
            'Breathe. Relax. Trust the journey.',
            'Sometimes, just surviving the day is a victory.',
            'Smiles are contagious — pass them on.',
            'Joy comes from within, not from what surrounds you.',
        ];

        // Shuffle and pick 45
        shuffle($sampleContents);
        $posts = array_slice($sampleContents, 0, 45);

        foreach ($posts as $content) {
            Post::create([
                'user_id' => 1,
                'content' => $content,
                'mood' => $moods[array_rand($moods)],
                'tag' => $tags[array_rand($tags)],
                'likes_count' => rand(0, 20),
                'status' => 'approved',
                'sentiment' => $sentiments[array_rand($sentiments)],
                'created_at' => now()->subDays(rand(1, 30))->setTime(rand(8, 23), rand(0, 59)),
            ]);
        }
    }
}
