<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenAiSentimentService
{
    protected $apiKey;
    protected $endpoint;

    public function __construct()
    {
        $this->apiKey = config('services.openai.key');
        $this->endpoint = 'https://api.openai.com/v1/chat/completions';
    }

    public function analyze(string $text): string
    {
        //Log::debug("IN OpenAI library");
        //Log::debug($text);

        $response = Http::withToken($this->apiKey)->post($this->endpoint, [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant that classifies short gratitude or kind messages. Return only "positive" or "negative" based on emotional tone and safety.'],
                ['role' => 'user', 'content' => $text],
            ],
            'temperature' => 0.3,
            'max_tokens' => 5,
        ]);
        //Log::debug('Response : ');
        //Log::debug($response);


        if ($response->failed()) {
            throw new \Exception('Sentiment API request failed.');
        }

        $result = strtolower(trim($response->json('choices.0.message.content')));

        return str_contains($result, 'negative') ? 'negative' : 'positive';
    }
}
